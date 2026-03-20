<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit();
}

require_once 'model/Database.php';
$database = new Database();
$conn = $database->getConnection();

// 1. Get the boat name from the URL parameter
$target_boat = isset($_GET['boat']) ? $_GET['boat'] : '';

// 2. Fetch all available boats for the dropdown
$boats = $conn->query("SELECT * FROM boats WHERE status = 'Available'");

$pageTitle = "NDTBS - Complete Your Booking";
include 'src/includes/header.php';
include 'src/includes/sidebar.php'; 
?>

<div class="ml-64 p-8 bg-gray-50 min-h-screen">
    <header class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Finalize Your Trip</h2>
        <p class="text-gray-500 text-sm">You are booking: <span class="font-bold text-blue-600"><?= htmlspecialchars($target_boat) ?: 'a Custom Trip' ?></span></p>
    </header>

    <div class="max-w-xl bg-white p-10 rounded-[2rem] shadow-xl border border-gray-100">
        <form action="actions/booking_proc.php" method="POST" class="space-y-8">
            
            <div class="space-y-2">
                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">Preferred Date</label>
                <input type="date" name="booking_date" required min="<?= date('Y-m-d') ?>"
                       class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 outline-none focus:ring-2 focus:ring-blue-400 transition">
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">Confirm Your Vessel</label>
                <select name="boat_id" required 
                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 outline-none focus:ring-2 focus:ring-blue-400 transition appearance-none">
                    <option value="" disabled <?= empty($target_boat) ? 'selected' : '' ?>>-- Select Boat --</option>
                    <?php while($boat = $boats->fetch_assoc()): ?>
                        <option value="<?= $boat['id'] ?>" <?= ($target_boat === $boat['name']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($boat['name']) ?> (Max: <?= $boat['capacity'] ?> Persons)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="p-4 bg-blue-50 rounded-2xl border border-blue-100">
                <p class="text-[10px] text-blue-700 font-bold uppercase leading-relaxed">
                    Note: Your request will be sent to the admin. You will receive a notification once the status changes from "Pending".
                </p>
            </div>

            <button type="submit" class="w-full bg-slate-900 text-white font-black py-5 rounded-2xl shadow-lg hover:bg-blue-600 transition-all uppercase tracking-widest text-sm">
                Request Booking
            </button>
        </form>
    </div>
</div>

<?php include 'src/includes/footer.php'; ?>