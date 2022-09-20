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
            <span style="font-size: 16px;">HOMEs</span>

          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/inspection-and-acceptance') }}">
            <i class="fa fa-list-ol" aria-hidden="true"></i>
            <span style="font-size: 14px;"> Inspection and Acceptance</span>
          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/request') }}">
            <i class="fa fa-wpforms" aria-hidden="true"></i>
            <span style="font-size: 14px;">Requisition and Issue Slip</span>
          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/stock-card') }}">
            <i class="fa fa-tags" aria-hidden="true"></i>
            <span style="font-size: 14px;">Stock Card</span>
          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/property-card') }}">
            <i class="fa fa-suitcase" aria-hidden="true"></i>
            <span style="font-size: 14px;">Property Card</span>
          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/report-on-the-physical-count-of-property-plant-and-equipment') }}">
            <i class="fa fa-book" aria-hidden="true"></i>
            <span style="font-size: 14px;">RPCPPE</span>
          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/inventory-custodian-slip') }}">
            <i class="fa fa-folder-open" aria-hidden="true"></i>
            <span style="font-size: 14px;">Inventory Custodian Slip</span>
          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/property-acknowledgement-receipt') }}">
            <i class="fa fa-briefcase" aria-hidden="true"></i>
            <span style="font-size: 14px;">Property Acknowledgement</br> Receipt</span>
          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/supplies-and-materials') }}">
            <i class="fa fa-archive" aria-hidden="true"></i>
            <span style="font-size: 14px;">Supplies and Materials Issued</span>
          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/report-on-physical-count-of-inventories') }}">
            <i class="fa fa-newspaper-o" aria-hidden="true"></i>
            <span style="font-size: 14px;">Physical Count of Inventories</span>
          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/repair-and-maintenance') }}">
            <i class="fa fa-wrench" aria-hidden="true"></i>
            <span style="font-size: 14px;">Repair and Maintenace</span>
          </a>
        </li>
        <li class="sidebar-menu">
          <a href="{{ url('/waste-materials') }}">
            <i class="fa fa-filter" aria-hidden="true"></i>
            <span style="font-size: 14px;">Waste Material Report</span>
          </a>
        </li>
         <li class="sidebar-menu">
          <a href="{{ url('/disposals') }}">
            <i class="fa fa-trash-o" aria-hidden="true"></i>
            <span style="font-size: 14px;">Disposal</span>
          </a>
        </li>
        {{--
        <li class="sidebar-menu">
          <a href="{{ url('/supplies-summary') }}">
            <i class="fa fa-list-alt" aria-hidden="true"></i>
            <span style="font-size: 14px;">Re-Order Point</span>
          </a>
        </li>
        --}}
        <li class="sidebar-menu">
          <a href="{{ url('/library') }}">
            <i class="fa fa-list" aria-hidden="true"></i>
            <span style="font-size: 14px;">Library</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>