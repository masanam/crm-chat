<x-modal
  title="Edit Team Members"
  name="edit-team-members"
  submitText="Save"
>
  <div class="d-flex flex-column gap-4">
    <x-input-floating
      label="Team"
      placeholder="Please select team"
      type="select"
      id="team"
      name="team"
      :options="$teams"
    >
    </x-input-floating>
    <x-input-floating
      label="Role"
      placeholder="Please select role"
      type="select"
      id="role"
      name="role"
      :options="$listRole"
    >
    </x-input-floating>
    <x-input-floating
      label="Status"
      placeholder="Please select status"
      type="select"
      id="status"
      name="status"
      :options="$listStatus"
    >
    </x-input-floating>
  </div>
</x-modal>