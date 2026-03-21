<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit();
}

require_once 'model/Database.php';
$booking_id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$booking_id) {
    header("Location: transaction.php");
    exit();
}

$pageTitle = "NDTBS - Secure Payment";
include 'src/includes/header.php'; 
include 'src/includes/sidebar.php'; 
?>

<div class="ml-64 p-10 bg-gray-50 min-h-screen">
    <div class="max-w-xl mx-auto bg-white p-10 rounded-[2.5rem] shadow-xl border border-gray-100">
        <div class="mb-8">
            <h2 class="text-2xl font-black text-slate-800">Finalize Payment</h2>
            <p class="text-gray-400 text-xs uppercase tracking-widest font-bold">Booking Reference: #TRN-<?= htmlspecialchars($booking_id) ?></p>
        </div>

        <form action="actions/payment_proc.php" method="POST" class="space-y-8">
            <input type="hidden" name="booking_id" value="<?= $booking_id ?>">

            <div class="grid grid-cols-2 gap-4">
                <label class="relative cursor-pointer">
                    <input type="radio" name="payment_method" value="GCash" class="peer sr-only" checked onclick="togglePaymentView('gcash')">
                    <div class="p-6 border-2 border-gray-100 rounded-2xl peer-checked:border-blue-500 peer-checked:bg-blue-50 transition">
                        <p class="font-bold text-slate-700">GCash</p>
                        <p class="text-[10px] text-gray-400 uppercase">E-Wallet</p>
                    </div>
                </label>
                <label class="relative cursor-pointer">
                    <input type="radio" name="payment_method" value="Onsite" class="peer sr-only" onclick="togglePaymentView('onsite')">
                    <div class="p-6 border-2 border-gray-100 rounded-2xl peer-checked:border-amber-500 peer-checked:bg-amber-50 transition">
                        <p class="font-bold text-slate-700">Onsite</p>
                        <p class="text-[10px] text-gray-400 uppercase">Cash at Office</p>
                    </div>
                </label>
            </div>

            <div id="gcash_section" class="space-y-6">
                <div class="p-4 bg-blue-600 rounded-2xl text-white">
                    <p class="text-[10px] font-bold uppercase opacity-80">Merchant GCash Number</p>
                    <p class="text-lg font-mono font-bold">0912-345-6789</p>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Reference Number (13 Digits)</label>
                    <input type="text" name="ref_no" id="ref_no" required placeholder="Enter GCash Ref #" 
                           class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:ring-2 focus:ring-blue-400 font-mono">
                </div>
            </div>

            <div id="onsite_section" class="hidden p-6 bg-slate-50 rounded-2xl border border-dashed border-gray-200 text-center">
                <p class="text-sm text-gray-600">Please settle your payment at the <span class="font-bold">Main Wharf Office</span> at least 30 minutes before departure.</p>
            </div>

            <button type="submit" class="w-full bg-slate-900 text-white font-black py-5 rounded-2xl hover:bg-blue-600 transition shadow-2xl uppercase tracking-widest text-xs">
                Submit Payment Info
            </button>
        </form>
    </div>
</div>

<script src="public/assets/js/payment.js"></script>

<?php include 'src/includes/footer.php'; ?>