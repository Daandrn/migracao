<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dados Gerais') }}
        </h2>
    </x-slot>

    @foreach ($geral['compras'] as $tabela)
        <div>
            Tabela: {{ $tabela['nome'] }}
        </div>
        <div>
            @if ($tabela['existe'])
                Quantidade: {{ $tabela['quantidade'] }}
            @else
                Não foram migrados dados para {{ $tabela['nome'] }}.
            @endif
        </div>
    @endforeach

    @foreach ($principal['veiculos'] as $tabela)
        <div>
            Tabela: {{ $tabela['nome'] }}
        </div>
        <div>
            @if ($tabela['existe'])
                Quantidade: {{ $tabela['quantidade'] }}
            @else
                Não foram migrados dados para {{ $tabela['nome'] }}.
            @endif
        </div>
    @endforeach
    
</x-app-layout>