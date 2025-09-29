use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/friends', function (Request $request) {
return response()->json([
['id' => 1, 'name' => 'Alice', 'lat' => 51.845, 'lng' => 5.852], // dicht bij Nijmegen centrum
['id' => 2, 'name' => 'Bob', 'lat' => 51.840, 'lng' => 5.860],   // ook in Nijmegen
['id' => 3, 'name' => 'Charlie', 'lat' => 51.850, 'lng' => 5.855], // oostelijk
['id' => 4, 'name' => 'Diana', 'lat' => 51.838, 'lng' => 5.848],   // zuid-west
]);
});

