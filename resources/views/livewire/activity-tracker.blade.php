<div class="container">

    <h5 class=" stylish-heading">DoICTs</h5>

    <div class="container mb-4">
        <!-- Success Alert Message -->
        @if (session()->has('message'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- Modal alert for showing delete activity --}}
        @include('livewire.delete-activity')


        <div class="card shadow-sm mt-1">
            <div class="card-body">
                <p class="card-text">
                    Welcome to your Daily Activities, <strong>{{ Auth::user()->name }}</strong>!
                </p>
                <p class="card-text">
                    You belong to the unit: <strong>{{ Auth::user()->unit->name }}</strong>.
                </p>
            </div>
        </div>


        <div class="card">



            <div class="card-header  d-flex flex-wrap align-items-center justify-content-between">

                <!-- Add activity button -->
                <button class="btn btn-secondary mb-2 mr-2" data-toggle="modal" data-target="#addActivityModal">
                    <i class="fas fa-plus"></i> New Activity <!-- Font Awesome plus icon -->
                </button>

                <button class="btn btn-secondary mr-2" data-toggle="modal" data-target="#customPrintModal">
                    <i class="fas fa-print"></i> Custom Report
                </button>

                <!-- Search Bar -->
                <div class=" mb-2 mt-2" style="flex: 0 1 400px;">
                    <input type="text" wire:model="search" placeholder="Search activities..."
                        class="form-control rounded-pill shadow-sm " />
                </div>

                <!-- Filter Buttons -->
                <div class="btn-group" role="group">
                    <button wire:click="loadActivities('all')" class="btn btn-primary">
                        <i class="fas fa-list"></i> All
                    </button>
                    <button wire:click="loadActivities('open')" class="btn btn-warning">
                        <i class="fas fa-folder-open"></i> Open
                    </button>
                    <button wire:click="loadActivities('closed')" class="btn btn-success">
                        <i class="fas fa-check-circle"></i> Closed
                    </button>
                </div>


                <!-- Progress Bar -->
                <div x-data="{ completionPercentage: @entangle('completionPercentage') }">
                    <label for="progress-bar">Activity Completion Progress</label>
                    <div class="progress-3d mb-2" id="progress-bar" aria-label="Activity Completion Progress">
                        <div class="progress-bar-3d" role="progressbar"
                            :style="{ width: Math.min(Math.max(completionPercentage, 0), 100) + '%' }"
                            :aria-valuenow="Math.min(Math.max(completionPercentage, 0), 100)" aria-valuemin="0"
                            aria-valuemax="100">
                            <span x-text="Math.round(Math.min(Math.max(completionPercentage, 0), 100)) + '%'"></span>
                            <div class="bubbles">
                                <div class="bubble"
                                    x-bind:style="{ left: Math.min(Math.max(completionPercentage, 0), 100) + '%' }">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="card-body "> --}}
            <div class="card-body table-container">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm table-hover text-center">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th style="width: 5%;">Tick</th>
                                <th style="width: 10%;">Date</th>
                                <th style="width: 10%;">Description</th>
                                <th style="width: 10%;">Submitter</th>
                                <th style="width: 10%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($activities as $activity)
                                <tr>
                                    <td>
                                        <input type="checkbox" wire:click="toggleDeleteIcon({{ $activity->id }})"
                                            aria-label="Select activity for deletion">
                                    </td>
                                    <td>{{ $activity->date }}</td>
                                    <td>{{ $activity->description }}</td>
                                    <td>{{ $activity->submitter }}</td>
                                    <td>
                                        <button class="btn mb-2 btn-info btn-sm"
                                            wire:click="viewActivity({{ $activity->id }})" data-toggle="modal"
                                            data-target="#viewActivityModal"
                                            aria-label="View details of {{ $activity->description }}"
                                            title="View Activity">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn mb-2 btn-secondary btn-sm"
                                            wire:click="editActivity({{ $activity->id }})" data-toggle="modal"
                                            data-target="#editActivityModal"
                                            aria-label="Edit details of {{ $activity->name }}" title="Edit Activity">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        @if (in_array($activity->id, $showDelete))
                                            <button class="btn btn-danger btn-sm"
                                                onclick="confirmDelete({{ $activity->id }})"
                                                aria-label="Delete {{ $activity->description }}"
                                                title="Delete Activity">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No activities found for this filter.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Always-Visible Pagination -->
                {{-- <div class="d-flex justify-content-center">
                        @if ($activities->hasPages('pagination::bootstrap-4'))
                            {{ $activities->links('pagination::bootstrap-4') }}
                        @else
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item disabled"><span class="page-link">Previous</span></li>
                                    <li class="page-item active"><span class="page-link">1</span></li>
                                    <li class="page-item disabled"><span class="page-link">Next</span></li>
                                </ul>
                            </nav>
                        @endif
                    </div> --}}
            </div>


            {{-- </div> --}}
        </div>



        <!-- Add Activity Modal -->
        <div wire:ignore.self class="modal fade" id="addActivityModal" tabindex="-1"
            aria-labelledby="addActivityModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form wire:submit.prevent="createActivity">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addActivityModalLabel">Add Activity</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @include('livewire.add-activity') <!-- comming from partial views -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Activity</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Activity Modal -->
        <div wire:ignore.self class="modal fade" id="editActivityModal" tabindex="-1"
            aria-labelledby="editActivityModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form wire:submit.prevent="updateActivity">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editActivityModalLabel">Edit Activity</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @include('livewire.edit-activity')
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- View Activity Modal -->
        <div wire:ignore.self class="modal fade" id="viewActivityModal" tabindex="-1"
            aria-labelledby="viewActivityModalLabel" aria-hidden="true">
            <div class="modal-dialog d-flex align-items-center" style="min-height: 100vh;">
                <div class="modal-content" style="font-size: 1.2rem;"> <!-- Increased font size -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="viewActivityModalLabel" style="font-size: 1.5rem;">View Activity
                        </h5> <!-- Larger heading -->
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body text-center">
                                <!-- Date with custom background color -->
                                <p><strong>Date:</strong> <span class="badge badge-info">{{ $date }}</span>
                                </p>

                                <!-- Name of the activity -->
                                <p><strong>Description:</strong> {{ $description }}</p>

                                <!-- Status with conditional color -->
                                <span
                                    class="badge {{ $status == 'Completed' ? 'bg-success text-white' : ($status == 'In Progress' ? 'bg-warning text-black' : ($status == 'Not Started' ? 'bg-secondary text-white' : 'bg-dark text-white')) }} font-size-lg py-2">
                                    {{ $status }}
                                </span>

                                <p><strong>Submitter</strong> {{ $submitter }}</p>

                                <!-- Large text area for Comments -->
                                <p><strong>Comments:</strong></p>
                                <textarea class="form-control" rows="5" readonly style="font-size: 1rem;">{{ $comments }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $activities->links('pagination::bootstrap-4') }}
        </div>




        <!-- Print Modal -->
        <div wire:ignore.self class="modal fade" id="customPrintModal" tabindex="-1" role="dialog"
            aria-labelledby="customPrintModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="customPrintModalLabel">Custom Print</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Livewire Form -->
                        <form wire:submit.prevent="customPrint">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" id="start_date" wire:model="start_date"
                                        class="form-control" required>
                                    @error('start_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" id="end_date" wire:model="end_date" class="form-control"
                                        required>
                                    @error('end_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="javascript:void(0)" onclick="validateAndRedirect()" class="btn btn-primary">
                                    Custom Print
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>







        {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Ensures Livewire is loaded before attaching events
                if (typeof Livewire === 'undefined') {
                    console.error('Livewire is not loaded.');
                    return;
                }

                // Close modals and display success alert on activity save
                Livewire.on('activitySaved', () => {
                    $('#addActivityModal, #editActivityModal').modal('hide');

                    const alert = document.getElementById('success-alert');
                    if (alert) {
                        alert.style.display = 'block';
                        setTimeout(() => {
                            alert.style.display = 'none';
                        }, 3000);
                    }
                });

                // Update progress bar dynamically
                Livewire.on('progressUpdated', (percentage) => {
                    const progressBar = document.querySelector('.progress-bar');
                    if (progressBar) {
                        progressBar.style.width = `${percentage}%`;
                        progressBar.setAttribute('aria-valuenow', percentage);
                        progressBar.innerText = `${Math.round(percentage)}%`;
                    }
                });

                document.addEventListener('DOMContentLoaded', function() {
                    const bubbleContainer = document.querySelector('.bubbles');

                    for (let i = 0; i < 10; i++) {
                        const bubble = document.createElement('div');
                        bubble.classList.add('bubble');
                        bubble.style.left = `${Math.random() * 100}%`;
                        bubble.style.animationDuration =
                            `${Math.random() * 3 + 2}s`; // Random duration between 2-5 seconds
                        bubbleContainer.appendChild(bubble);
                    }
                });


                // Confirm deletion modal handler
                window.confirmDelete = function(activityId) {
                    const confirmModal = $('#deleteConfirmModal');
                    const confirmButton = document.getElementById('confirmDeleteBtn');

                    if (confirmModal.length && confirmButton) {
                        confirmModal.modal('show');
                        confirmButton.onclick = () => {
                            Livewire.emit('deleteConfirmed', activityId);
                            confirmModal.modal('hide');
                        };
                    } else {
                        console.error('Confirm Delete Modal or Button not found.');
                    }
                };

            });

            // Define the function globally
            function validateAndRedirect() {
                // Get the values of the date inputs
                const start_date = document.getElementById('start_date').value;
                const end_date = document.getElementById('end_date').value;

                // Check if both dates are selected
                if (!start_date || !end_date) {
                    alert('Please select both start and end dates before printing.');
                    return; // Stop further execution if validation fails
                }

                // Validate the date format (optional)
                const datePattern = /^\d{4}-\d{2}-\d{2}$/;
                if (!datePattern.test(start_date) || !datePattern.test(end_date)) {
                    alert('Please enter valid dates in the format YYYY-MM-DD.');
                    return;
                }

                // Ensure start_date is not greater than end_date
                if (new Date(start_date) > new Date(end_date)) {
                    alert('The start date cannot be later than the end date.');
                    return;
                }

                // Construct the custom URL with the selected dates
                const url = `{{ route('activities.custom-print') }}?start_date=${start_date}&end_date=${end_date}`;

                // Open the URL in a new tab
                window.open(url, '_blank');
            }
        </script>
