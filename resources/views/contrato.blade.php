<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contratos') }}
        </h2>
    </x-slot>

    <div class="flex flex-row gap-x-6">
        @if (@isset($contratos))
            <div class="flex flex-col gap-y-5">
            
                @foreach ($contratos as $tabela)
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

        @if (@isset($contratos))
            <div class="flex flex-col gap-y-5">
            
                @foreach ($contratos as $tabela)
                    @if ($tabela['erro'])
                        <span class="flex flex-col border border-solid border-gray-400">
                            <div>
                                Nome: {{ $tabela['nome'] }}
                            </div>
                            <div>
                                Tabela: {{ $tabela['tabela'] }}
                            </div>
                            <div class="p-x-2">
                                    
                            </div>
                        </span>
                    @endif
                @endforeach
            </div>
        @endif
    
</x-app-layout>