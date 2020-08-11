<h3>Menu</h3>
<ul class="nav side-menu">
    <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-home"></i> Overview</a>
    @if(Auth::user()->isAn('admin'))
    <li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-user-plus"></i> Daftar Users</a>
    @elseif(Auth::user()->isAn('kader'))
    <li><a href="{{ route('dashboard.children.index') }}"><i class="fa fa-user"></i> Daftar Anak</a>
    <li><a href="{{ route('dashboard.activity.index') }}"><i class="fa fa-sellsy"></i> Daftar KMS</a>
    @elseif(Auth::user()->isAn('bidan'))
    <li><a href="{{ route('dashboard.family.index') }}"><i class="fa fa-users"></i> Daftar Pasangan</a>
    <li><a href="{{ route('dashboard.pregnant.index') }}"><i class="fa fa-female"></i> Layanan Ibu Hamil</a>
    @endif

</ul>
