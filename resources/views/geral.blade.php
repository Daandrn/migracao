<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dados Gerais') }}
        </h2>
    </x-slot>

    <div class="flex flex-row gap-x-6">
        @if (@isset($geral['compras']))
            <div class="flex flex-col gap-y-5">
                <h3>
                    <b>{{ ucfirst($geral->keys()[0]) }}</b>
                </h3>
            
                @foreach ($geral['compras'] as $tabela)
                    <span class="flex flex-col border border-solid border-gray-400">
                        <div>
                            Nome: {{ $tabela['nome'] }}
                        </div>
                        <div>
                            Tabela: {{ $tabela['tabela'] }}
                        </div>
                        <div class="p-x-2">
                            @if ($tabela['existe'])
                                Quantidade: {{ $tabela['quantidade'] }}
                            @else
                                Não foram migrados dados para {{ $tabela['tabela'] }}.
                            @endif
                        </div>
                    </span>
                @endforeach
            </div>
        @endif

        @if (@isset($geral['licitacoes']))
            <div class="flex flex-col gap-y-5">
                <h3>
                    <b>{{ ucfirst($geral->keys()[1]) }}</b>
                </h3>
            
                @foreach ($geral['licitacoes'] as $tabela)
                    <span class="flex flex-col border border-solid border-gray-400">
                        <div>
                            Nome: {{ $tabela['nome'] }}
                        </div>
                        <div>
                            Tabela: {{ $tabela['tabela'] }}
                        </div>
                        <div class="p-x-2">
                            @if ($tabela['existe'])
                                Quantidade: {{ $tabela['quantidade'] }}
                            @else
                                Não foram migrados dados para {{ $tabela['tabela'] }}.
                            @endif
                        </div>
                    </span>
                @endforeach
            </div>
        @endif

        @if (@isset($geral['contratos']))
            <div class="flex flex-col gap-y-5">
                <h3>
                    <b>{{ ucfirst($geral->keys()[2]) }}</b>
                </h3>
            
                @foreach ($geral['contratos'] as $tabela)
                    <span class="flex flex-col border border-solid border-gray-400">
                        <div>
                            Nome: {{ $tabela['nome'] }}
                        </div>
                        <div>
                            Tabela: {{ $tabela['tabela'] }}
                        </div>
                        <div class="p-x-2">
                            @if ($tabela['existe'])
                                Quantidade: {{ $tabela['quantidade'] }}
                            @else
                                Não foram migrados dados para {{ $tabela['tabela'] }}.
                            @endif
                        </div>
                    </span>
                @endforeach
            </div>
        @endif

        @if (@isset($geral['veiculos']))
            <div class="flex flex-col gap-y-5">
                <h3>
                    <b>{{ ucfirst($geral->keys()[3]) }}</b>
                </h3>
            
                @foreach ($geral['veiculos'] as $tabela)
                    <span class="flex flex-col border border-solid border-gray-400">
                        <div>
                            Nome: {{ $tabela['nome'] }}
                        </div>
                        <div>
                            Tabela: {{ $tabela['tabela'] }}
                        </div>
                        <div class="p-x-2">
                            @if ($tabela['existe'])
                                Quantidade: {{ $tabela['quantidade'] }}
                            @else
                                Não foram migrados dados para {{ $tabela['tabela'] }}.
                            @endif
                        </div>
                    </span>
                @endforeach
            </div>
        @endif

    </div>
    
</x-app-layout>