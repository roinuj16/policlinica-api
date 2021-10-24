<aside class="sidebar-left">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{url("template/resources/img/icons/icon-user.png")}}" class="img-circle" alt="User Image">
            </div>
            <div class="info">
                <p>Bem Vindo</p>
                <p><small>{{ Auth::user()->name }}</small>
                </p>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <li class="treeview active"><a href="{{url('/home')}}"><i class="fa fa-home"></i> <span>Painel</span></a>
            </li>

            <li class="treeview">
                <a href="#"><i class="fa fa-cogs"></i> <span>Configuração</span>
                    <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('list-users') }}">Usuários</a></li>
                    <li><a href="{{ url('form-banner') }}">Banner</a></li>
                    <li><a href="{{ url('form-logo') }}">Logo</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-file"></i> <span>Paginas</span>
                    <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('especialidades')}}">Especialidades</a></li>
                    <li><a href="{{url('blog')}}">Informativos</a></li>
                    <li><a href="{{url('quem-somos')}}">Quem Somos</a></li>
                    <li><a href="{{url('convenios')}}">Convênios</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-laptop"></i> <span>Cursos</span>
                    <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('cursos')}}">Cursos</a></li>
                    <li><a href="{{url('list-ebooks')}}">E-Books</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-area-chart"></i> <span>Relatórios</span>
                    <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('pedidos')}}">Pedidos</a></li>
                    <li><a href="{{url('listar-alunos')}}">Alunos</a></li>
                </ul>
            </li>
           <li class="treeview">
                <a href="#"><i class="fa fa-area-chart"></i> <span>Pacientes</span>
                    <span class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('pacientes')}}">Consultar</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>


