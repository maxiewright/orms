<?php //13a6b41556eb40fcdac170ea4f91885f
/** @noinspection all */

namespace App\Events {

    use App\Models\User;
    use Illuminate\Broadcasting\PendingBroadcast;

    /**
     * @method static void dispatch(User $user)
     * @method static PendingBroadcast broadcast(User $user)
     */
    class UserCreated {}
}

namespace Filament\Events {

    use Filament\Models\Contracts\HasTenants;
    use Illuminate\Broadcasting\PendingBroadcast;
    use Illuminate\Contracts\Auth\Authenticatable;
    use Illuminate\Database\Eloquent\Model;

    /**
     * @method static void dispatch(Model $tenant, HasTenants|Authenticatable|Model $user)
     * @method static PendingBroadcast broadcast(Model $tenant, HasTenants|Authenticatable|Model $user)
     */
    class TenantSet {}
}

namespace Filament\Notifications\Events {

    use Illuminate\Broadcasting\PendingBroadcast;
    use Illuminate\Contracts\Auth\Authenticatable;
    use Illuminate\Database\Eloquent\Model;

    /**
     * @method static void dispatch(Authenticatable|Model $user)
     * @method static PendingBroadcast broadcast(Authenticatable|Model $user)
     */
    class DatabaseNotificationsSent {}
}

namespace Illuminate\Foundation\Console {

    use Illuminate\Foundation\Bus\PendingDispatch;

    /**
     * @method static PendingDispatch dispatch(array $data)
     * @method static mixed dispatchSync(array $data)
     */
    class QueuedCommand {}
}

namespace Illuminate\Foundation\Events {

    use Illuminate\Broadcasting\PendingBroadcast;

    /**
     * @method static void dispatch(array $stubs)
     * @method static PendingBroadcast broadcast(array $stubs)
     */
    class PublishingStubs {}
}

namespace Illuminate\Queue {

    use Illuminate\Foundation\Bus\PendingDispatch;
    use Laravel\SerializableClosure\SerializableClosure;

    /**
     * @method static PendingDispatch dispatch(SerializableClosure $closure)
     * @method static mixed dispatchSync(SerializableClosure $closure)
     */
    class CallQueuedClosure {}
}

namespace orms\vendor\maatwebsite\excel\src\Jobs {

    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Foundation\Bus\PendingDispatch;
    use Maatwebsite\Excel\Concerns\FromQuery;
    use Maatwebsite\Excel\Concerns\FromView;
    use Maatwebsite\Excel\Files\TemporaryFile;

    /**
     * @method static PendingDispatch dispatch(object $sheetExport, TemporaryFile $temporaryFile, string $writerType, int $sheetIndex, array $data)
     * @method static mixed dispatchSync(object $sheetExport, TemporaryFile $temporaryFile, string $writerType, int $sheetIndex, array $data)
     */
    class AppendDataToSheet {}
    
    /**
     * @method static PendingDispatch dispatch(FromQuery $sheetExport, TemporaryFile $temporaryFile, string $writerType, int $sheetIndex, int $page, int $chunkSize)
     * @method static mixed dispatchSync(FromQuery $sheetExport, TemporaryFile $temporaryFile, string $writerType, int $sheetIndex, int $page, int $chunkSize)
     */
    class AppendQueryToSheet {}
    
    /**
     * @method static PendingDispatch dispatch(FromView $sheetExport, TemporaryFile $temporaryFile, string $writerType, int $sheetIndex)
     * @method static mixed dispatchSync(FromView $sheetExport, TemporaryFile $temporaryFile, string $writerType, int $sheetIndex)
     */
    class AppendViewToSheet {}
    
    /**
     * @method static PendingDispatch dispatch(object $export, TemporaryFile $temporaryFile, string $writerType)
     * @method static mixed dispatchSync(object $export, TemporaryFile $temporaryFile, string $writerType)
     */
    class QueueExport {}
    
    /**
     * @method static PendingDispatch dispatch(ShouldQueue $import = null)
     * @method static mixed dispatchSync(ShouldQueue $import = null)
     */
    class QueueImport {}
}

namespace bfinlay\SpreadsheetSeeder\Events {

    use Illuminate\Broadcasting\PendingBroadcast;

    /**
     * @method static void dispatch(string $message, false|string $level = FALSE)
     * @method static PendingBroadcast broadcast(string $message, false|string $level = FALSE)
     */
    class Console {}
}

namespace bfinlay\SpreadsheetSeeder\Readers\Events {

    use bfinlay\SpreadsheetSeeder\Readers\Rows;
    use Illuminate\Broadcasting\PendingBroadcast;
    use Symfony\Component\Finder\SplFileInfo;

    /**
     * @method static void dispatch(Rows $rows)
     * @method static PendingBroadcast broadcast(Rows $rows)
     */
    class ChunkFinish {}
    
    /**
     * @method static void dispatch(Rows $rows)
     * @method static PendingBroadcast broadcast(Rows $rows)
     */
    class ChunkStart {}
    
    /**
     * @method static void dispatch(SplFileInfo $file)
     * @method static PendingBroadcast broadcast(SplFileInfo $file)
     */
    class FileFinish {}
    
    /**
     * @method static void dispatch(SplFileInfo $file)
     * @method static PendingBroadcast broadcast(SplFileInfo $file)
     */
    class FileSeed {}
    
    /**
     * @method static void dispatch(SplFileInfo $file)
     * @method static PendingBroadcast broadcast(SplFileInfo $file)
     */
    class FileStart {}
    
    /**
     * @method static void dispatch(string $sheetName, string $tableName, $startRow = 0, array $header = [])
     * @method static PendingBroadcast broadcast(string $sheetName, string $tableName, $startRow = 0, array $header = [])
     */
    class SheetFinish {}
    
    /**
     * @method static void dispatch(string $sheetName, string $tableName, $startRow = 0, array $header = [])
     * @method static PendingBroadcast broadcast(string $sheetName, string $tableName, $startRow = 0, array $header = [])
     */
    class SheetStart {}
}

namespace pxlrbt\FilamentExcel\Events {

    use Illuminate\Broadcasting\PendingBroadcast;

    /**
     * @method static void dispatch(string $filename, int|null|string $userId)
     * @method static PendingBroadcast broadcast(string $filename, int|null|string $userId)
     */
    class ExportFinishedEvent {}
}
