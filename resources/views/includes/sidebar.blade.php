<h3>Menu Admin</h3>
<ul class="nav side-menu">
    <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-home"></i> Overview</a>
{{--    <li><a href="{{ route('catatan-bayi.index') }}"><i class="fa fa-home"></i> Catatan Bayi</a>--}}
{{--    </li>--}}
{{--    <li><a><i class="fa fa-edit"></i> Register KMS <span class="fa fa-chevron-down"></span></a>--}}
{{--        <ul class="nav child_menu">--}}
{{--            <li><a href="{{ route('kms-01') }}">Tahun 0-1</a></li>--}}
{{--            <li><a href="{{ route('kms-12') }}">Tahun 1-2</a></li>--}}
{{--            <li><a href="{{ route('kms-23') }}">Tahun 2-3</a></li>--}}
{{--            <li><a href="{{ route('kms-34') }}">Tahun 3-4</a></li>--}}
{{--            <li><a href="{{ route('kms-45') }}">Tahun 4-5</a></li>--}}
{{--            <li><a href="{{ route('kms-bayi.create') }}">Input KMS</a></li>--}}
{{--        </ul>--}}
{{--    </li>--}}
    <li><a href="{{ route('dashboard.family.index') }}"><i class="fa fa-home"></i> Daftar Pasangan</a>
      <li><a href="{{ route('dashboard.pregnant.index') }}"><i class="fa fa-home"></i> Layanan Ibu Hamil</a>
    <li><a href="{{ route('dashboard.children.index') }}"><i class="fa fa-home"></i> Daftar Anak</a>
    <li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-home"></i> Daftar Users</a>
</ul>
