<nav id="primary" class="main-menu">
	<ul class="main-menu__list">
		<li class="main-menu__item">
			<a class="main-menu__item__link" href="/painel">
				<?php \App\Helpers\SvgHelper::render(['name' => 'home', 'class' => 'center']); ?>
				<span class="main-menu__item__text">Home</span>
			</a>
		</li>

		@if (auth()->user()->is_super_admin)
			<li class="main-menu__item">
				<a class="main-menu__item__link" href="{{ route('usuarios.index') }}">
					<?php \App\Helpers\SvgHelper::render(['name' => 'user', 'class' => 'center']); ?>
					<span class="main-menu__item__text">Usuários</span>
				</a>
			</li>
		@endif

		<li class="main-menu__item main-menu__item--submenu{{ Route::is('projetos.*') ? ' main-menu__item--submenu-active' : '' }}">
			<a class="main-menu__item__link" href="/painel/projetos">
				<?php \App\Helpers\SvgHelper::render(['name' => 'projects', 'class' => 'center']); ?>
				<span class="main-menu__item__text">Projetos</span>
			</a>
			<ul class="main-menu__submenu">
				<li class="main-menu__submenu__item">
					<a class="main-menu__submenu__item__link" href="{{ route('projetos.create') }}">
						<span class="main-menu__submenu__item__text">Novo projeto</span>
						<?php \App\Helpers\SvgHelper::render(['name' => 'more', 'class' => 'center']); ?>
					</a>
				</li>
			</ul>
		</li>

		<li class="main-menu__item main-menu__item--submenu{{ Route::is('listas.*') || Route::is('tarefas.*') ? ' main-menu__item--submenu-active' : '' }}">
			<a class="main-menu__item__link" href="/painel/listas">
				<?php \App\Helpers\SvgHelper::render(['name' => 'tasks', 'class' => 'center']); ?>
				<span class="main-menu__item__text">Tarefas</span>
			</a>
			<ul class="main-menu__submenu">
				<li class="main-menu__submenu__item">
					<a class="main-menu__submenu__item__link" href="{{ route('listas.create') }}">
						<span class="main-menu__submenu__item__text">Nova lista</span>
						<?php \App\Helpers\SvgHelper::render(['name' => 'more', 'class' => 'center']); ?>
					</a>
				</li>
				<li class="main-menu__submenu__item">
					<a class="main-menu__submenu__item__link" href="{{ route('tarefas.create') }}">
						<span class="main-menu__submenu__item__text">Nova tarefa</span>
						<?php \App\Helpers\SvgHelper::render(['name' => 'more', 'class' => 'center']); ?>
					</a>
				</li>
			</ul>
		</li>
	</ul>
</nav>