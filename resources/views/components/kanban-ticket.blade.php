<link rel="stylesheet" href="{{asset('css/components/ticket-kanban.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/jkanban/jkanban.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/toastr/toastr.css')}}" />

<script src="{{asset('assets/vendor//libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor//libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor//libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor//libs/jkanban/jkanban.js')}}"></script>
<script src="{{asset('assets/vendor//libs/toastr/toastr.js')}}"></script>

<script src="{{asset('js/components/ticket-kanban.js')}}"></script>
<script>
  $(function () {
    // Select2
    var select2 = $('.select2');
    if (select2.length) {
      select2.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>').select2({
          dropdownParent: $this.parent(),
          placeholder: $this.data('placeholder'), // for dynamic placeholder
          dropdownCss: {
            minWidth: '150px' // set a minimum width for the dropdown
          }
        });
      });
      $('.select2-selection__rendered').addClass('w-px-150');
    }
  });

  $(document).ready(function () {
    $('#team_id').on('change', function (e) {
      var team_id = $(this).val();
      $.get(baseUrl + 'api/get-members?team_id=' + team_id, function (res) {
        const data = res.results;
        $("#member_id").empty()
        data.forEach((item) => {
          $("#member_id").append('<option value="' + item.id + '">' + item.name + '</option>')
        })
      })
    });
  });
</script>

<div class="app-kanban">
  <div class="kanban-wrapper"></div>
</div>