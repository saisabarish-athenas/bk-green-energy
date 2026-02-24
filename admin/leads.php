<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/auth.php';
requireLogin();

$db = getDB();

// Handle status update
if (isset($_POST['update_status'])) {
    $stmt = $db->prepare("UPDATE leads SET status = ? WHERE id = ?");
    $stmt->execute([$_POST['status'], $_POST['lead_id']]);
}

// Export to CSV
if (isset($_GET['export'])) {
    $leads = $db->query("SELECT * FROM leads ORDER BY created_at DESC")->fetchAll();
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="leads_' . date('Y-m-d') . '.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID', 'Name', 'Phone', 'Email', 'Company', 'Location', 'Message', 'Source', 'Status', 'Date']);
    foreach ($leads as $lead) {
        fputcsv($output, $lead);
    }
    fclose($output);
    exit;
}

$leads = $db->query("SELECT * FROM leads ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Leads - BK Green Energy Admin</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar { background: #0f7c3a; min-height: 100vh; color: white; }
        .sidebar a { color: white; text-decoration: none; padding: 10px 20px; display: block; }
        .sidebar a:hover { background: #19a84a; }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar p-3" style="width: 250px;">
            <h4 class="mb-4">BK Admin</h4>
            <a href="dashboard.php">Dashboard</a>
            <a href="projects.php">Projects</a>
            <a href="clients.php">Clients</a>
            <a href="gallery.php">Gallery</a>
            <a href="leads.php">Leads</a>
            <a href="logout.php">Logout</a>
        </div>
        <div class="flex-grow-1 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Manage Leads</h2>
                <a href="?export=1" class="btn btn-success">Export to CSV</a>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($leads as $lead): ?>
                    <tr>
                        <td><?= date('M d, Y', strtotime($lead['created_at'])) ?></td>
                        <td><?= htmlspecialchars($lead['name']) ?></td>
                        <td><?= htmlspecialchars($lead['email']) ?></td>
                        <td><?= htmlspecialchars($lead['phone'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars(substr($lead['message'], 0, 50)) ?>...</td>
                        <td>
                            <form method="POST" class="d-inline">
                                <input type="hidden" name="lead_id" value="<?= $lead['id'] ?>">
                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="new" <?= $lead['status'] === 'new' ? 'selected' : '' ?>>New</option>
                                    <option value="contacted" <?= $lead['status'] === 'contacted' ? 'selected' : '' ?>>Contacted</option>
                                    <option value="converted" <?= $lead['status'] === 'converted' ? 'selected' : '' ?>>Converted</option>
                                    <option value="closed" <?= $lead['status'] === 'closed' ? 'selected' : '' ?>>Closed</option>
                                </select>
                                <input type="hidden" name="update_status" value="1">
                            </form>
                        </td>
                        <td>
                            <a href="mailto:<?= htmlspecialchars($lead['email']) ?>" class="btn btn-sm btn-primary">Email</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
