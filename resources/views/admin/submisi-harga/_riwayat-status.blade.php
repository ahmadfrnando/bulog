<div class="card-body-custom">
    @foreach ($riwayat as $data)
        <div class="timeline-item">
            <div class="timeline-date">
                <i class="fas fa-clock"></i>
                {{ \Carbon\Carbon::parse($data->created_at)->formatLocalized('%d %B %Y, %H:%M') }}
            </div>
            <div class="timeline-content">
                <strong>{{ $data->getStatus($data->nama_status)['label'] }}</strong><br>
                <small>{{ $data->getStatus($data->nama_status)['desc'] }}</small>
            </div>
        </div>
    @endforeach
</div>
