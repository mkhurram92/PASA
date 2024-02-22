 <!-- External CSS -->
 <link href="https://unpkg.com/tabulator-tables@5.1.5/dist/css/tabulator.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

 <!-- External JavaScript Libraries -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://unpkg.com/tabulator-tables@5.1.5/dist/js/tabulator.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
 <script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.20/jspdf.plugin.autotable.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

 @include('layout.header')
 @include('layout.sidebar')
 <!-- app-content start-->
 <div class="app-content main-content">
     <div class="side-app">
         <div class="container-fluid main-container">
             <div class="page-header">
                 <div class="page-leftheader">
                     <h3 class="page-title">Account List</h3>
                 </div>
                 <div class="card-header d-flex justify-content-between align-items-center">
                     <a class="btn btn-primary" href="javascript:void(0)" id="create-record">
                         <i class="fa fa-plus-circle" style="font-size:24px;"></i>
                     </a>
                 </div>
             </div>
             <a href="{{ route('accounts.create') }}" class="btn btn-success">Create Account</a>

             <table class="table">
                 <thead>
                     <tr>
                         <th>ID</th>
                         <th>Name</th>
                         <th>Type</th>
                         <th>Balance</th>
                         <th>Actions</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($accounts as $account)
                     <tr>
                         <td>{{ $account->id }}</td>
                         <td>{{ $account->name }}</td>
                         <td>{{ $account->type }}</td>
                         <td>{{ $account->balance }}</td>
                         <td>
                             <a href="{{ route('accounts.show', $account->id) }}" class="btn btn-info">View</a>
                             <a href="{{ route('accounts.edit', $account->id) }}" class="btn btn-warning">Edit</a>
                             <form action="{{ route('accounts.destroy', $account->id) }}" method="POST" style="display: inline;">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                             </form>
                         </td>
                     </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </div>
 </div>
 
 @include('layout.footer')