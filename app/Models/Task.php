<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'status',
        'priority',
        'due_date',
    ];

    protected function casts(): array
    {
        return [
            'due_date' => 'datetime',
            'created_at' => 'datetime',
        ];
    }
    //Relasi Task ke Category (Many to One)
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    //Get all tasks 
    public static function getAllTasks()
    {
        return self::with('category')->get();
    }

    //Get task by ID
    public static function getTaskById($id)
    {
        return self::with('category')->findOrFail($id);
    }

    //Get Pending Tasks
    public static function getPendingTasks()
    {
        return self::with('category')->where('status', 'pending')->get();
    }

    //Get Completed Tasks
    public static function getCompletedTasks()
    {
        return self::with('category')->where('status', 'completed')->get();
    }

    public static function getFilteredTasks($filters, $sort)
    {
        // Mulai query dengan relasi
        $query = self::with('category');

        // Filter berdasarkan status
        if (!empty($filters['status']) && in_array($filters['status'], ['pending', 'completed'])) {
            $query->where('status', $filters['status']);
        }

        // Filter berdasarkan kategori
        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        // Filter pencarian
        if (!empty($filters['search'])) {
            $query->where('title', 'like', '%' . $filters['search'] . '%');
        }

        // Sorting
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'due_date_asc':
                $query->orderBy('due_date', 'asc');
                break;
            case 'due_date_desc':
                $query->orderBy('due_date', 'desc');
                break;
            case 'priority_high':
                $query->orderByRaw("FIELD(priority, 'high', 'medium', 'low')");
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        return $query->paginate(10);
    }
}
