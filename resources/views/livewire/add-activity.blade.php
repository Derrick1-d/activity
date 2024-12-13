


    <div class="card-body">
        <div class="form-group">
            <label for="description" class="font-weight-bold">Description</label>
            <input type="text" id="description" class="form-control" wire:model="description" placeholder="Enter description" required>
        </div>
        <div class="form-group">
            <label for="date" class="font-weight-bold">Date</label>
            <input type="date" id="date" class="form-control" wire:model="date" required>
        </div>
        <div class="form-group">
            <label for="status" class="font-weight-bold">Status</label>
            <select id="status" class="form-control" wire:model="status" required>
                <option value="">Select Status</option>
                <option value="completed">Completed</option>
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
            </select>
        </div>
        <div class="form-group">
            <label for="submitter">Submitter</label>
            <input type="text" id="submitter" wire:model="submitter" required>
        </div>
        <div class="form-group">
            <label for="comments" class="font-weight-bold">Comments</label>
            <textarea id="comments" class="form-control" wire:model="comments" rows="4" placeholder="Add your comments..."></textarea>
        </div>
    </div>


