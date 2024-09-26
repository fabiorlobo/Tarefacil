<ul class="footer__links">
	<li>
		<a href="/sobre" @if (Request::is('painel*')) target="_blank" rel="noopener noreferrer" @endif >
			Sobre
		</a>
	</li>
	<li>
		<a href="/privacidade" @if (Request::is('painel*')) target="_blank" rel="noopener noreferrer" @endif>
			Privacidade
		</a>
	</li>
</ul>

<span class="footer__copyright">&copy; 2024 Tarefácil. Todos os direitos reservados.</span>