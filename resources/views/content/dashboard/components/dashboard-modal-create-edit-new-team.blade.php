<x-modal
  title="Create New Team"
  name="add-team"
  submitText="Create Team"
>
  <div class="d-flex flex-column gap-3">
    <div class="d-flex flex-column">
        <h6 class="text-dark">Team Details</h6>
        <div class="d-flex flex-column gap-3">
            <x-input-floating
                label="Team Name"
                placeholder="Please input team name"
                id="team name"
                name="team name"
            ></x-input-floating>
            <x-input-floating
              label="Function"
              placeholder="Please select function"
              type="select"
              id="function"
              name="function"
              :options="$listRole"
            >
            </x-input-floating>
            <x-input-floating
                id="group description"
                name="group description"
                label="Group Description"
                placeholder="Please input group description"
                type="textarea"
                cols="33"
                rows="5"
            ></x-input-floating>
        </div>
    </div>
  </div>
</x-modal>