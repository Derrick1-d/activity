
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" id="description" class="form-control" wire:model="description" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" id="date" class="form-control" wire:model="date" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" class="form-control" wire:model="status" required>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                        </select>
                    </div>
                    <div>
                        <label for="person_worked_for">Person Worked For:</label>
                        <input type="text" id="submitter" wire:model="submitter" required>
                    </div>
                    <div class="form-group">
                        <label for="comments">Comments</label>
                        <textarea id="comments" class="form-control" wire:model="comments"></textarea>
                    </div>



