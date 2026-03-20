<?php
session_start();
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: admin_login.php?error=restricted");
    exit();
}

require_once 'model/Database.php';
require_once 'model/Admin.php';

$database = new Database();
$adminObj = new Admin($database->getConnection());
$bookings = $adminObj->getPendingBookings();

$pageTitle = "NDTBS - Manage Bookings";
include 'src/includes/header.php'; 
?>

<?php include 'src/includes/sidebar.php'; ?>

<div class="ml-64 p-10 bg-gray-50 min-h-screen">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-slate-800">Trip Bookings Management</h2>
        <div class="flex gap-2">
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-[10px] font-bold uppercase tracking-widest">
                <?= $bookings->num_rows ?> Active Requests
            </span>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                <tr>
                    <th class="p-6">Customer Details</th>
                    <th class="p-6">Boat Name</th>
                    <th class="p-6">Trip Date</th>
                    <th class="p-6">Status / Payment</th>
                    <th class="p-6">Action</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <?php if($bookings->num_rows > 0): ?>
                    <?php while($row = $bookings->fetch_assoc()): ?>
                    <tr class="border-t border-gray-50 hover:bg-gray-50 transition">
                        <td class="p-6">
                            <div class="font-bold text-slate-700"><?= htmlspecialchars($row['fname'] . " " . $row['lname']) ?></div>
                            <div class="text-[10px] text-gray-400"><?= htmlspecialchars($row['user_email']) ?></div>
                        </td>
                        <td class="p-6 font-medium text-slate-600"><?= htmlspecialchars($row['boat_name']) ?></td>
                        <td class="p-6">
                            <div class="text-blue-600 font-bold"><?= date('M d, Y', strtotime($row['booking_date'])) ?></div>
                        </td>
                        <td class="p-6">
                            <?php if($row['status'] === 'Awaiting Verification'): ?>
                                <div class="bg-purple-50 p-2 rounded-xl border border-purple-100">
                                    <p class="text-[9px] font-black text-purple-700 uppercase mb-1">GCash Ref:</p>
                                    <p class="font-mono text-xs font-bold text-purple-900"><?= htmlspecialchars($row['reference_no']) ?></p>
                                </div>
                            <?php else: ?>
                                <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded-full text-[10px] font-bold uppercase">
                                    <?= $row['status'] ?>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="p-6">
                            <form action="actions/admin_booking_proc.php" method="POST" class="flex gap-2">
                                <input type="hidden" name="booking_id" value="<?= $row['id'] ?>">
                                
                                <?php if($row['status'] === 'Pending'): ?>
                                    <button type="submit" name="action" value="Confirmed" class="bg-emerald-500 text-white px-4 py-2 rounded-xl font-bold hover:bg-emerald-600 transition shadow-lg shadow-emerald-100">Approve</button>
                                    <button type="submit" name="action" value="Cancelled" class="bg-rose-500 text-white px-4 py-2 rounded-xl font-bold hover:bg-rose-600 transition shadow-lg shadow-rose-100">Decline</button>
                                
                                <?php elseif($row['status'] === 'Awaiting Verification'): ?>
                                    <button type="submit" name="action" value="Paid" class="bg-blue-600 text-white px-5 py-2 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-100">Mark Paid</button>
                                <?php endif; ?>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="p-20 text-center text-gray-400 italic">No pending trip bookings at the moment.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'src/includes/footer.php'; ?>