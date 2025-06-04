@foreach($menus as $menu)
	@if(isset($menu['type']) && $menu['type'] === 'heading')
		<div class="menu-item pt-5">
			<div class="menu-content">
				<span class="menu-heading fw-bold text-uppercase fs-7">{{ $menu['title'] }}</span>
			</div>
		</div>
	@else
		<div class="menu-item">
			<a href="{{ route($menu['route']) }}" class="menu-link">
                <span class="menu-icon">
                    <i class="{{ $menu['icon'] }}">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                    </i>
                </span>
				<span class="menu-title">{{ $menu['title'] }}</span>
			</a>
		</div>
	@endif
@endforeach
