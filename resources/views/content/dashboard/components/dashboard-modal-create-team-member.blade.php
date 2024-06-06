<x-modal
  title="Add Team Members"
  name="add-team-members"
  submitText="Add Members"
>
  <div class="d-flex flex-column gap-4">
    <x-input-floating
      label="Email addresses"
      placeholder="Please select email"
      type="select-multiple"
      id="email"
      name="email"
      :options="$emailsAddress"
    >
    </x-input-floating>
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
  </div>
</x-modal>