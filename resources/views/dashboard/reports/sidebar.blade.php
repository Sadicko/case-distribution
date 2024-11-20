 <div class="list-unstyled list-group">
   <a href="{{ route('reports', ['q' => 'by-status']) }}" class="list-group-item list-group-item-action {{ $activeStatus == 'statuses' ? 'text-info' : '' }} "> <i class="fas fa-exclamation-circle"></i> By status</a>
   <a href="{{ route('reports', ['q' => 'by-courts']) }}" class="list-group-item list-group-item-action {{ $activeStatus == 'court' ? 'text-info' : '' }} "> <i class="fas fa-balance-scale"></i>  By Courts</a>
   <a href="{{ route('reports', ['q' => 'by-registries']) }}" class="list-group-item list-group-item-action {{ $activeStatus == 'registries' ? 'text-info' : '' }}"> <i class="fas fa-folder"></i>  By Registry</a>
   <a href="{{ route('reports', ['q' => 'by-region']) }}" class="list-group-item list-group-item-action {{ $activeStatus == 'regions' ? 'text-info' : '' }}"><i class="fas fa-globe"></i>  By Region</a>
   <a href="{{ route('reports', ['q' => 'by-bail-type']) }}" class="list-group-item list-group-item-action {{ $activeStatus == 'bail-type' ? 'text-info' : '' }}"><i class="fas fa-list"></i>  By Bail type</a>
</div>