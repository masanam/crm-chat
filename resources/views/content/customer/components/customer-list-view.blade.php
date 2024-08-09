@php
$headerItem = (object) [
  'name' => 'Customer',
  'width' => '200px'
];

$headerItem2 = (object) [
  'name' => 'Stage',
  'width' => '40px'
];

$headerItem3 = (object) [
  'name' => 'Pipeline',
  'width' => '200px'
];

$headerItem4 = (object) [
  'name' => 'Estimated closed date',
  'width' => '700px'
];

$headerItem5 = (object) [
  'name' => 'Company',
  'width' => '200px'
];

$headerItem6 = (object) [
  'name' => 'Value',
  'width' => '100px'
];

$headerItem7 = (object) [
  'name' => 'Date created',
  'width' => '300px'
];

$headerItem8 = (object) [
  'name' => 'Date modified',
  'width' => '300px'
];

$headers = [$headerItem, $headerItem2, $headerItem3, $headerItem4, $headerItem5, $headerItem6, $headerItem7, $headerItem8];

$dummyData = (object) [
  'customer' => 'John Doe',
  'stage' => 'New',
  'pipeline' => 'Sales Executive',
  'estClosedDate' => 'Jul 24, 2024',
  'company' => 'PT Maju Mundur',
  'value' => 200,
  'createdAt' => '31 May 2024 10.00',
  'updatedAt' => '31 May 2024 15.00'
];

$dummyData2 = (object) [
  'customer' => 'Jane Doe',
  'stage' => 'In Negotiation',
  'pipeline' => 'Sales Executive',
  'estClosedDate' => 'Jul 24, 2024',
  'company' => 'PT Maju Mundur',
  'value' => 200,
  'createdAt' => '31 May 2024 10.00',
  'updatedAt' => '31 May 2024 15.00'
];

$listData = [$dummyData, $dummyData2];


@endphp
<section class="d-flex tab-pane fade active show" id="list-view" role="tabpanel">

<div class="card-body table-responsive pt-0">
      <table class="table table-bordered data-leads">
        <thead>
          <tr>
            <th>No</th>
            <th>Client Nama</th>
            <th>Phone Number</th>
            <th>Unit</th>
            <th>Status</th>
            <th>Payment Method</th>
            <th>Budget</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    </div>
</section>