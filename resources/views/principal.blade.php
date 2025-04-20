<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Principal') }}
        </h2>
    </x-slot>

    <h2>
        Bem vindo ao ajudante de verificação de dados migrados!
    </h2>

    <h3>
        Para visualizar <b>Dados Gerais da Migração</b>, acesse a aba <x-nav-link :href="route('geral')">{{ __('Dados Gerais') }}</x-nav-link>.
    </h3>

    <h3>
        Para visualizar dados do <b>Compras</b>, acesse a aba <x-nav-link :href="route('compras')">{{ __('Compras') }}</x-nav-link>.
    </h3>

    <h3>
        Para visualizar dados das <b>Licitações</b>, acesse a aba <x-nav-link :href="route('licitacao')">{{ __('Licitações') }}</x-nav-link>.
    </h3>

    <h3>
        Para visualizar dados dos <b>Contratos</b>, acesse a aba <x-nav-link :href="route('contrato')">{{ __('Contratos') }}</x-nav-link>.
    </h3>
    
</x-app-layout>