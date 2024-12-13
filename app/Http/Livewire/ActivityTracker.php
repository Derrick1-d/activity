<?php

namespace App\Http\Livewire;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ActivityTracker extends Component
{
    use WithPagination;

    public $search = '';

    public $description;

    public $date;

    public $status;

    public $submitter;

    public $comments;

    public $editMode = false;

    public $activityId;

    public $showDelete = [];

    public $completionPercentage = 0;

    public $start_date;

    public $end_date;

    public $filter = 'all'; // 'all', 'open', or 'closed'

    // Event listeners
    public $listeners = [
        'deleteConfirmed' => 'deleteActivity',
        'activityUpdated' => 'updateCompletionPercentage',
    ];

    // Validation rules
    protected $rules = [
        'description' => 'required|string|max:255',
        'date' => 'required|date',
        'status' => 'required|in:completed,pending,in_progress',
        'submitter' => 'nullable|string|max:255',
        'comments' => 'nullable|string|max:500',
    ];

    public function mount()
    {
        if (! Auth::check()) {
            abort(403, 'Unauthorized action.');
        }

        $this->updateCompletionPercentage(); // Recalculate progress on component initialization
    }

    public function render()
    {
    // Start building the query
        $query = Activity::where('user_id', Auth::id()) // Filter by authenticated user
            ->where(function ($query) {
                $query->where('description', 'like', '%'.$this->search.'%') // Search by name
                      ->orWhere('status', 'like', '%'.$this->search.'%'); // Search by status
            });

        // Apply filtering logic based on the filter property
        if (isset($this->filter)) {
            if ($this->filter === 'open') {
                $query->whereIn('status', ['in_progress', 'pending']); // Adjust status values as needed
            } elseif ($this->filter === 'closed') {
                $query->where('status', 'completed');
            }
        }

        // Order and paginate results
        $activities = $query->orderBy('date', 'desc')->paginate(10);

        // Return the view with activities
        return view('livewire.activity-tracker', [
            'activities' => $activities,
        ]);
    }

    public function toggleDeleteIcon($id)
    {
        if (in_array($id, $this->showDelete)) {
            $this->showDelete = array_diff($this->showDelete, [$id]);
        } else {
            $this->showDelete[] = $id;
        }
    }

    public function createActivity()
    {
        $this->validate();

        Activity::create([
            'user_id' => Auth::id(), // Associate with the authenticated user
            'description' => $this->description,
            'date' => $this->date,
            'status' => $this->status,
            'submitter' => $this->submitter,
            'comments' => $this->comments,
        ]);

        $this->resetForm();
        $this->updateCompletionPercentage();
        $this->emit('activitySaved');
        session()->flash('message', 'Activity created successfully.');
    }

    public function viewActivity($id)
    {
        $activity = Activity::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $this->activityId = $activity->id;
        $this->description = $activity->description;
        $this->date = $activity->date;
        $this->status = $activity->status;
        $this->submitter = $activity->submitter;
        $this->comments = $activity->comments;
    }

    public function editActivity($id)
    {
        $activity = Activity::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $this->activityId = $activity->id;
        $this->description = $activity->description;
        $this->date = $activity->date;
        $this->status = $activity->status;
        $this->comments = $activity->comments;
        $this->submitter = $activity->submitter;
        $this->editMode = true;
    }

    public function updateActivity()
    {
        $this->validate();

        $activity = Activity::where('id', $this->activityId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $activity->update([
            'description' => $this->description,
            'date' => $this->date,
            'status' => $this->status,
            'submitter' => $this->submitter,
            'comments' => $this->comments,
        ]);

        $this->resetForm();
        $this->updateCompletionPercentage();
        $this->emit('activitySaved');
        session()->flash('message', 'Activity updated successfully.');
    }

    public function deleteActivity($id)
    {
        $activity = Activity::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $activity->delete();
        $this->updateCompletionPercentage();
        session()->flash('message', 'Activity deleted successfully.');
    }

    private function resetForm()
    {
        $this->description = '';
        $this->date = '';
        $this->status = '';
        $this->comments = '';
        $this->submitter = '';
        $this->editMode = false;
        $this->activityId = null;
    }

    private function calculateProgress()
    {
        $totals = Activity::where('user_id', Auth::id())
            ->selectRaw('
                COUNT(*) as total,
                SUM(status = "completed") as completed,
                SUM(status = "in_progress") as in_progress
            ')
            ->first();

        return [
            'total' => $totals->total,
            'completed' => $totals->completed,
            'in_progress' => $totals->in_progress,
        ];
    }

    public function updateCompletionPercentage()
    {
        $progress = $this->calculateProgress();

        $this->completionPercentage = $progress['total'] > 0
            ? (($progress['completed'] * 1) + ($progress['in_progress'] * 0.5)) / $progress['total'] * 100
            : 0;

        $this->emit('progressUpdated', $this->completionPercentage);
    }

    public function loadActivities($filter)
    {
        $this->filter = $filter;
    }
}
