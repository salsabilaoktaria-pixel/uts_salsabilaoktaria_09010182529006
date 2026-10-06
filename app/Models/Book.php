<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    /** Batas stok yang dianggap "menipis". */
    public const LOW_STOCK = 3;

    protected $fillable = [
        'category_id',
        'title',
        'author',
        'publisher',
        'year',
        'stock',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'stock' => 'integer',
        ];
    }

    /**
     * Relationship: setiap buku dimiliki oleh satu kategori (belongsTo).
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Bonus: pencarian berdasarkan judul atau penulis.
     */
    public function scopeSearch(Builder $query, ?string $keyword): Builder
    {
        return $query->when($keyword, function (Builder $q) use ($keyword) {
            $q->where(function (Builder $w) use ($keyword) {
                $w->where('title', 'like', "%{$keyword}%")
                  ->orWhere('author', 'like', "%{$keyword}%");
            });
        });
    }

    /**
     * Bonus: filter berdasarkan kategori.
     */
    public function scopeOfCategory(Builder $query, $categoryId): Builder
    {
        return $query->when($categoryId, fn (Builder $q) => $q->where('category_id', $categoryId));
    }

    /**
     * Buku dengan stok menipis (termasuk habis).
     */
    public function scopeLowStock(Builder $query): Builder
    {
        return $query->where('stock', '<=', self::LOW_STOCK);
    }

    /**
     * Kelas CSS label stok (didefinisikan di layouts/app.blade.php).
     */
    public function stockBadgeClass(): string
    {
        return match (true) {
            $this->stock === 0 => 'pill stock-out',
            $this->stock <= self::LOW_STOCK => 'pill stock-low',
            default => 'pill stock-ok',
        };
    }

    /**
     * Teks status stok.
     */
    public function stockLabel(): string
    {
        return match (true) {
            $this->stock === 0 => 'Habis',
            $this->stock <= self::LOW_STOCK => 'Menipis',
            default => 'Tersedia',
        };
    }
}
