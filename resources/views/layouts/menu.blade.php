<li class="nav-item">
    <a href="/home" class="nav-link {{ Request::is('home*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>
        Dashboard
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('userStudents.index') }}" class="nav-link {{ Request::is('userStudents*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Daftar Mahasiswa</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('userTeachers.index') }}" class="nav-link {{ Request::is('userTeachers*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-graduation-cap"></i>
        <p>Daftar Dosen</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('subjects.index') }}" class="nav-link {{ Request::is('subjects*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-book"></i>
        <p>Daftar Matakuliah</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('teachingPeriods.index') }}" class="nav-link {{ Request::is('teachingPeriods*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar"></i>
        <p>Tahun Ajaran</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('classrooms.index') }}" class="nav-link {{ Request::is('classrooms*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-clock"></i>
        <p>Daftar Kelas</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('classroomUsers.index') }}"
       class="nav-link {{ Request::is('classroomUsers*') ? 'active' : '' }}">
        <p>Classroom Users</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('profiles.index') }}"
       class="nav-link {{ Request::is('profiles*') ? 'active' : '' }}">
        <p>Profiles</p>
    </a>
</li>


