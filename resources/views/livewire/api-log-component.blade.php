<div>
    <!-- Bootstrap Table with Header - Light -->
    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header">Lista</h5>
            <div class="d-flex align-items-center p-4">
                {{-- <button wire:click.prevent="$set('modo' , 'edit')" class="btn btn-sm btn-primary">Nuevo</button> --}}
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                <tr>
                    <th>Fecha</th>
                    <th>Text</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0 w-100">
                    @foreach($logs as $log)
                        <tr>
                        <td>{{ $log->created_at->format('d/m/Y') }}</td>
                        <td style="white-space: wrap;word-wrap: break-all;">{{ $log->main }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $logs->links() }}
        </div>
    </div>
    <!-- Bootstrap Table with Header - Light -->
</div>
