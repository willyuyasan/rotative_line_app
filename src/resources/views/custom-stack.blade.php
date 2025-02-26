<!-- resources/views/custom-stack.blade.php-->
<div>
    <div class="flex gap-2">
        <x-heroicon-s-magnifying-glass class="w-5 h-5 text-primary-500" />
        <div class="text-sm">{{ $getRecord()->issuer_tax_number }}</div>
    </div>
    <div class="flex gap-2">
        <x-heroicon-s-building-office-2 class="w-5 h-5 text-primary-500" />
        <div class="text-sm">{{ $getRecord()->issuer_name}}</div>
    </div>
</div>