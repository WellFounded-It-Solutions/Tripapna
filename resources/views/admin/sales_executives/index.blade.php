@extends('layouts.admin_design')
@section('content')

<div class="content-wrapper">
   <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Sales Excecutive </h1>
                </div>
         </div>
      </div>
   </section>
   <section class="content">
      <div class="container-fluid">
      <a href="{{ route('sales_executives.create') }}" class="btn btn-primary mb-3">Add New</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="salesExecutivesTable">
            <!-- Sales Executives will be loaded here by AJAX -->
        </tbody>
    </table>
      </div>
   </section>
</div>

</div>

@endsection
@section('scripts')
<!-- Ensure jQuery is loaded before any custom scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    alert('sdsdsdsd')
    // $(document).ready(function() {
        loadSalesExecutives();

        function loadSalesExecutives() {
            $.ajax({
                url: "{{ route('sales_executives.index') }}",
                method: "GET",
                success: function(data) {
                    $('#salesExecutivesTable').html(data);
                }
            });
        }

        $(document).on('click', '.delete-button', function() {
            if (confirm('Are you sure you want to delete this Sales Executive?')) {
                let id = $(this).data('id');
                $.ajax({
                    url: '/sales_executives/' + id,
                    method: 'DELETE',
                    success: function(data) {
                        loadSalesExecutives();
                    }
                });
            }
        });
    // });
</script>
@endsection
