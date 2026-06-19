{{--
    Partial: Riwayat Booking
    Di-include dari profile/edit.blade.php — panel "bookings"
    Variabel: $bookings (LengthAwarePaginator, di-pass dari ProfileController)
--}}
<style>
    /* ── Booking panel styles (scoped prefix bk-) ───────────────── */
    .bk-header {
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 12px; margin-bottom: 22px;
    }
    .bk-new-btn {
        display: inline-flex; align-items: center; gap: 7px;
        background: #1A1A1A; color: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 12px; font-weight: 700; letter-spacing: .3px;
        padding: 9px 18px; border-radius: var(--radius-sm);
        text-decoration: none; transition: background var(--transition), transform var(--transition);
    }
    .bk-new-btn:hover { background: var(--gold-dark); transform: translateY(-1px); }

    /* Flash */
    .bk-flash {
        padding: 11px 14px; border-radius: var(--radius-sm);
        font-size: 13px; font-weight: 500; margin-bottom: 16px;
        border: 1px solid; display: flex; align-items: center; gap: 8px;
    }
    .bk-flash-ok  { background: var(--success-bg); color: var(--success); border-color: rgba(45,122,79,.2); }
    .bk-flash-err { background: var(--danger-bg);  color: var(--danger);  border-color: rgba(192,57,43,.2); }

    /* Stats */
    .bk-stats { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; margin-bottom: 18px; }
    .bk-stat {
        background: var(--surface-2); border: 1px solid var(--border);
        border-radius: var(--radius-md); padding: 14px 16px;
        display: flex; align-items: center; gap: 12px;
    }
    .bk-stat-icon { font-size: 18px; flex-shrink: 0; }
    .bk-stat-num  { font-size: 20px; font-weight: 700; color: var(--ink); line-height: 1; }
    .bk-stat-lbl  { font-size: 10px; color: var(--text-lo); text-transform: uppercase; letter-spacing: .5px; margin-top: 2px; }

    /* Card */
    .bk-card {
        background: var(--surface); border: 1px solid var(--border);
        border-radius: var(--radius-md); margin-bottom: 10px; overflow: hidden;
        transition: box-shadow var(--transition), transform var(--transition);
        animation: bkUp .3s both;
    }
    .bk-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,.07); transform: translateY(-1px); }
    @keyframes bkUp { from { opacity:0; transform:translateY(7px); } to { opacity:1; transform:translateY(0); } }

    .bk-card-inner { display: flex; }
    .bk-bar        { width: 4px; flex-shrink: 0; }
    .bk-card-body  { flex: 1; padding: 15px 18px; }

    .bk-card-top {
        display: flex; align-items: flex-start;
        justify-content: space-between; gap: 10px; margin-bottom: 10px;
    }
    .bk-pkg  { font-family: 'Cormorant Garamond', serif; font-size: 16px; font-weight: 600; color: var(--ink); line-height: 1.2; }
    .bk-ref  { font-size: 11px; color: var(--text-lo); font-family: monospace; margin-top: 2px; }

    .bk-badge {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 3px 11px; border-radius: 20px;
        font-size: 10px; font-weight: 700; white-space: nowrap; flex-shrink: 0;
        text-transform: uppercase; letter-spacing: .4px;
    }
    .bk-w  { background: #FEF3C7; color: #92400E; }
    .bk-d  { background: #FDECEA; color: #C0392B; }
    .bk-i  { background: #EBF3FB; color: #1E5FA8; }
    .bk-p  { background: #EDE9FE; color: #6D28D9; }
    .bk-s  { background: #E8F5EE; color: #2D7A4F; }

    .bk-meta { display: flex; gap: 14px; flex-wrap: wrap; }
    .bk-meta-item {
        display: flex; align-items: center; gap: 5px;
        font-size: 12px; color: var(--text-mid);
    }
    .bk-meta-item svg { width: 12px; height: 12px; color: var(--text-lo); flex-shrink: 0; }
    .bk-price { font-weight: 700; color: var(--gold-dark); font-size: 13px; }

    .bk-card-foot {
        display: flex; align-items: center; justify-content: space-between;
        padding: 9px 18px; border-top: 1px solid var(--border);
        background: var(--surface-2);
    }
    .bk-action {
        display: flex; align-items: center; gap: 5px;
        font-size: 11px; font-weight: 600; color: #92400E;
    }
    .bk-action::before {
        content: ''; width: 6px; height: 6px; border-radius: 50%;
        background: #F59E0B; animation: bkPulse 1.8s infinite;
    }
    @keyframes bkPulse { 0%,100%{opacity:1} 50%{opacity:.3} }
    .bk-created { font-size: 11px; color: var(--text-lo); }

    .bk-detail-btn {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 12px; font-weight: 600; color: var(--ink);
        background: var(--surface); border: 1px solid var(--border);
        padding: 6px 13px; border-radius: var(--radius-sm);
        text-decoration: none; transition: all var(--transition);
    }
    .bk-detail-btn:hover { border-color: var(--gold); color: var(--gold-dark); background: rgba(204,176,73,.06); }

    /* Empty */
    .bk-empty {
        text-align: center; padding: 56px 24px;
        background: var(--surface-2); border: 1px dashed var(--border);
        border-radius: var(--radius-md);
    }
    .bk-empty-icon  { font-size: 36px; margin-bottom: 14px; opacity: .55; }
    .bk-empty-title { font-family: 'Cormorant Garamond', serif; font-size: 21px; font-weight: 600; color: var(--ink); margin-bottom: 6px; }
    .bk-empty-sub   { font-size: 13px; color: var(--text-lo); margin-bottom: 20px; line-height: 1.6; }

    /* Pagination */
    .bk-pager { display: flex; justify-content: center; margin-top: 18px; gap: 5px; }
    .bk-pager .page-link, .bk-pager [aria-current] {
        display: inline-flex; align-items: center; justify-content: center;
        min-width: 32px; height: 32px; padding: 0 8px;
        border-radius: var(--radius-sm); font-size: 12px; font-weight: 500;
        text-decoration: none; border: 1px solid var(--border);
        color: var(--text-mid); background: var(--surface);
        transition: all var(--transition);
    }
    .bk-pager .page-link:hover { border-color: var(--gold); color: var(--gold-dark); }
    .bk-pager [aria-current]   { background: var(--ink); color: #fff; border-color: var(--ink); }

    @media (max-width: 600px) {
        .bk-stats    { grid-template-columns: 1fr 1fr; }
        .bk-card-top { flex-direction: column; gap: 6px; }
        .bk-meta     { gap: 10px; }
    }
</style>

@php
    $bkMap = [
        'menunggu_konfirmasi' => ['lbl' => 'Menunggu Konfirmasi', 'cls' => 'bk-w', 'bar' => '#F59E0B', 'ico' => ''],
        'ditolak'             => ['lbl' => 'Ditolak',             'cls' => 'bk-d', 'bar' => '#C0392B', 'ico' => ''],
        'menunggu_pembayaran' => ['lbl' => 'Menunggu Pembayaran', 'cls' => 'bk-i', 'bar' => '#1E5FA8', 'ico' => ''],
        'menunggu_verifikasi' => ['lbl' => 'Menunggu Verifikasi', 'cls' => 'bk-p', 'bar' => '#6D28D9', 'ico' => ''],
        'pembayaran_ditolak'  => ['lbl' => 'Pembayaran Ditolak',  'cls' => 'bk-d', 'bar' => '#C0392B', 'ico' => ''],
        'terkonfirmasi'       => ['lbl' => 'Terkonfirmasi',       'cls' => 'bk-s', 'bar' => '#2D7A4F', 'ico' => ''],
    ];
    $bkNeedAct = ['menunggu_pembayaran', 'pembayaran_ditolak'];
@endphp

{{-- Flash messages --}}
@if(session('success'))
    <div class="bk-flash bk-flash-ok">✓ {{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="bk-flash bk-flash-err">✗ {{ session('error') }}</div>
@endif

{{-- Header --}}
<div class="bk-header">
    <div>
        <div class="fs-panel-title">Riwayat Booking</div>
        <div class="fs-panel-desc">Semua sesi foto studio Anda tersimpan di sini.</div>
    </div>
    <a href="{{ route('bookings.create') }}" class="bk-new-btn">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Booking Baru
    </a>
</div>

{{-- Stats strip --}}
@if(isset($bookings) && $bookings->total() > 0)
<div class="bk-stats">
    <div class="bk-stat">
        <div class="bk-stat-icon"></div>
        <div>
            <div class="bk-stat-num">{{ $bookings->total() }}</div>
            <div class="bk-stat-lbl">Total</div>
        </div>
    </div>
    <div class="bk-stat">
        <div class="bk-stat-icon"></div>
        <div>
            <div class="bk-stat-num">{{ $bookings->getCollection()->whereIn('status',['menunggu_konfirmasi','menunggu_pembayaran','menunggu_verifikasi','pembayaran_ditolak'])->count() }}</div>
            <div class="bk-stat-lbl">Berjalan</div>
        </div>
    </div>
    <div class="bk-stat">
        <div class="bk-stat-icon"></div>
        <div>
            <div class="bk-stat-num">{{ $bookings->getCollection()->where('status','terkonfirmasi')->count() }}</div>
            <div class="bk-stat-lbl">Selesai</div>
        </div>
    </div>
</div>
@endif

{{-- Booking list --}}
@if(isset($bookings))
    @forelse($bookings as $i => $booking)
        @php
            $bks = $bkMap[$booking->status] ?? ['lbl' => $booking->status, 'cls' => 'bk-w', 'bar' => '#F59E0B', 'ico' => '?'];
            $needAct = in_array($booking->status, $bkNeedAct);
        @endphp
        <div class="bk-card" style="animation-delay:{{ $i * 0.04 }}s">
            <div class="bk-card-inner">
                <div class="bk-bar" style="background:{{ $bks['bar'] }}"></div>
                <div class="bk-card-body">
                    <div class="bk-card-top">
                        <div>
                            <div class="bk-pkg">{{ $booking->package->name ?? $booking->service }}</div>
                            <div class="bk-ref">#{{ $booking->booking_reference }}</div>
                        </div>
                        <span class="bk-badge {{ $bks['cls'] }}">{{ $bks['ico'] }} {{ $bks['lbl'] }}</span>
                    </div>
                    <div class="bk-meta">
                        <div class="bk-meta-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') }}
                        </div>
                        <div class="bk-meta-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            {{ \Carbon\Carbon::createFromTimeString($booking->booking_time)->format('H:i') }} WIB
                        </div>
                        <div class="bk-meta-item bk-price">
                            Rp {{ number_format($booking->price, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="bk-card-foot">
                <div>
                    @if($needAct)
                        <div class="bk-action">
                            @if($booking->status === 'menunggu_pembayaran') Segera lakukan pembayaran
                            @else Upload ulang bukti transfer
                            @endif
                        </div>
                    @else
                        <div class="bk-created">Dibuat {{ $booking->created_at->diffForHumans() }}</div>
                    @endif
                </div>
                <a href="{{ route('bookings.show', $booking) }}" class="bk-detail-btn">
                    Lihat Detail
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </div>
        </div>
    @empty
        <div class="bk-empty">
            <div class="bk-empty-icon">📷</div>
            <div class="bk-empty-title">Belum Ada Booking</div>
            <p class="bk-empty-sub">Anda belum pernah melakukan booking sesi foto.<br>Mulai dengan memilih paket yang sesuai.</p>
            <a href="{{ route('bookings.create') }}" class="bk-new-btn" style="display:inline-flex">Mulai Booking →</a>
        </div>
    @endforelse

    {{-- Pagination --}}
    @if($bookings->hasPages())
        <div class="bk-pager">
            {{ $bookings->appends(['tab' => 'bookings'])->links('pagination::simple-tailwind') }}
        </div>
    @endif
@else
    <div class="bk-empty">
        <div class="bk-empty-icon"></div>
        <div class="bk-empty-title">Data tidak tersedia</div>
        <p class="bk-empty-sub">Silakan refresh halaman.</p>
    </div>
@endif
