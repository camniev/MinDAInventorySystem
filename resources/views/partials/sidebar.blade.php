<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<style type="text/css">
  html,
body {
  height: 100% !important;
}
.layout-boxed html,
.layout-boxed body {
  height: 100%;
  list-style-type:none;
}
</style>
<aside class="main-sidebar">
    <section class="sidebar">

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header" style="color: #FAFAFA;">
          <a href="{{ url('/home') }}">
            <i style="font-size: 16px;" class="fa fa-home" aria-hidden="true"></i>
            <span style="font-size: 16px;">HOME</span>

          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/inspection-and-acceptance') }}">
            <i class="fa fa-list-ol" aria-hidden="true"></i>
            <span> Inspection and Acceptance</span>
          </a>
        </li>

        <li class="treeview sidebar-menu">
          <a href="#">
            <i class="fa fa-list-ol"></i> <span>Inspection and Acceptance</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.html"><i class="fa fa-circle-o"></i> Create New IAR</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> View Masterlist</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> View IARs by Suppliers</a></li>
          </ul>
        </li>

        <li class="sidebar-menu">
          <a href="{{ url('/request') }}">
            <i class="fa fa-wpforms" aria-hidden="true"></i>
            <span>Requisition and Issue Slip</span>
          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/stock-card') }}">
            <i class="fa fa-tags" aria-hidden="true"></i>
            <span>Stock Card</span>
          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/property-card') }}">
            <i class="fa fa-suitcase" aria-hidden="true"></i>
            <span>Property Card</span>
          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/report-on-the-physical-count-of-property-plant-and-equipment') }}">
            <i class="fa fa-book" aria-hidden="true"></i>
            <span>RPCPPE</span>
          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/inventory-custodian-slip') }}">
            <i class="fa fa-folder-open" aria-hidden="true"></i>
            <span>Inventory Custodian Slip</span>
          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/property-acknowledgement-receipt') }}">
            <i class="fa fa-briefcase" aria-hidden="true"></i>
            <span>Property Acknowledgement</br> Receipt</span>
          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/supplies-and-materials') }}">
            <i class="fa fa-archive" aria-hidden="true"></i>
            <span>Supplies and Materials Issued</span>
          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/report-on-physical-count-of-inventories') }}">
            <i class="fa fa-newspaper-o" aria-hidden="true"></i>
            <span>Physical Count of Inventories</span>
          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/repair-and-maintenance') }}">
            <i class="fa fa-wrench" aria-hidden="true"></i>
            <span>Repair and Maintenace</span>
          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/waste-materials') }}">
            <i class="fa fa-filter" aria-hidden="true"></i>
            <span>Waste Material Report</span>
          </a>
        </li>
         <li class="sidebar-menu">
          <a href="{{ url('/disposals') }}">
            <i class="fa fa-trash-o" aria-hidden="true"></i>
            <span>Disposal</span>
          </a>
        </li>
        {{--
        <li class="sidebar-menu">
          <a href="{{ url('/supplies-summary') }}">
            <i class="fa fa-list-alt" aria-hidden="true"></i>
            <span>Re-Order Point</span>
          </a>
        </li>
        --}}
        <li class="sidebar-menu">
          <a href="{{ url('/library') }}">
            <i class="fa fa-list" aria-hidden="true"></i>
            <span>Library</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>