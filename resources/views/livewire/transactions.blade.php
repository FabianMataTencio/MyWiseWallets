<div>
    <section class="mt-10 px-4">
        <div class="flex flex-col items-center gap-6">

            <div class="flex flex-col lg:hidden w-full items-center gap-4">
                <div class="flex flex-row items-center justify-center gap-4">
                    <div class="flex items-center justify-center">
                        <div class="porcentajes"
                            style="--porcentaje: {{ $percentage}};  --color:blue;">
                            <svg width="150" heigth="150">
                                <circle r="68" cx="50%" cy="50%" pathlength="100"class="bg-circle" />
                                <circle r="68" cx="50%" cy="50%" pathlength="100" class="progress-circle" />
                            </svg>
                            <span>{{number_format($percentage, 2)}}%</span>
                        </div>
                    </div>
                    <x-finance-box :title="__('Remaining Money')" :amount="$remaining_money" />
                </div>
            </div>

            <div class="hidden lg:flex lg:items-center lg:justify-center w-full">
                <div class="porcentajes"
                    style="--porcentaje: {{ $percentage}};  --color:blue;">
                    <svg width="150" heigth="150">
                        <circle r="68" cx="50%" cy="50%" pathlength="100"class="bg-circle" />
                        <circle r="68" cx="50%" cy="50%" pathlength="100" class="progress-circle" />
                    </svg>
                    <span>{{number_format($percentage, 2)}}%</span>
                </div>
            </div>
            
            <div class="mt-4 hidden lg:flex lg:flex-row lg:justify-center lg:gap-6 w-full">
                <x-finance-box :title="__('Total Income')" :amount="$total_income" />
                <x-finance-box :title="__('Remaining Money')" :amount="$remaining_money" />
                <x-finance-box :title="__('Total Outcome')" :amount="$total_outcome" />

            </div>
            
            <div class="mt-4 flex flex-col lg:hidden w-full items-center gap-4">
                <x-finance-box :title="__('Total Income')" :amount="$total_income" />
                <x-finance-box :title="__('Total Outcome')" :amount="$total_outcome" />
            </div>
        </div>
    </section>
</div>