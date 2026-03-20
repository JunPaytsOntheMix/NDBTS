<?php
session_start();
require_once 'model/Database.php';

// Security Gate: Ensure user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();
$user_email = $_SESSION['user_email'];

/**
 * FIXED QUERY: 
 * We now JOIN with 'boat_owners' because that is where 'boat_name' is stored.
 */
$query = "SELECT b.id, b.booking_date, b.status, b.payment_method, bt.boat_name 
          FROM bookings b
          JOIN boat_owners bt ON b.boat_id = bt.id
          WHERE b.user_email = ? 
          ORDER BY b.id DESC";

$stmt = $db->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

$pageTitle = "My Transactions";
include 'src/includes/header.php';
?>

<div class="p-8">
    <h1 class="text-2xl font-bold text-slate-800 mb-6">My Trip Transactions</h1>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 text-gray-400 text-[10px] uppercase tracking-widest font-bold">
                    <th class="px-6 py-4">Trans. ID</th>
                    <th class="px-6 py-4">Boat Name</th>
                    <th class="px-6 py-4">Schedule</th>
                    <th class="px-6 py-4">Payment</th>
                    <th class="px-6 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="border-t border-gray-50 hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4 font-medium text-slate-900">#<?= $row['id'] ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($row['boat_name']) ?></td>
                            <td class="px-6 py-4"><?= date('M d, Y', strtotime($row['booking_date'])) ?></td>
                            <td class="px-6 py-4">
                                <?php if (empty($row['payment_method'])): ?>
                                    <a href="payment.php?id=<?= $row['id'] ?>" class="text-blue-500 font-bold hover:underline">Pay Now</a>
                                <?php else: ?>
                                    <span class="text-gray-500 italic"><?= $row['payment_method'] ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase 
                                    <?= ($row['status'] === 'Pending') ? 'bg-amber-100 text-amber-600' : 'bg-emerald-100 text-emerald-600' ?>">
                                    <?= $row['status'] ?>
                                </span>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center text-gray-400 italic">
                            No transactions found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'src/includes/footer.php'; ?>