<h3 class="">Welcome to <?php echo $_settings->info('name'); ?></h3>
<hr>
<div class="row">
    <!-- Total Hall/Room -->
    <div class="col-lg-2 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $conn->query("SELECT COUNT(*) as count FROM `assembly_hall`")->fetch_assoc()['count']; ?></h3>
                <p>Total Hall/Room</p>
            </div>
            <div class="icon">
                <i class="fas fa-door-closed"></i>
            </div>
            <a href="./?page=assembly_hall" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Total Reservations -->
    <div class="col-lg-2 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?php echo $conn->query("SELECT COUNT(*) as count FROM `schedule_list` WHERE date(datetime_start) >= '" . date("Y-m-d") . "'")->fetch_assoc()['count']; ?></h3>
                <p>Total Reservations</p>
            </div>
            <div class="icon">
                <i class="fa fa-calendar-check"></i>
            </div>
            <a href="./?page=schedules" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Today's Schedule -->
    <div class="col-lg-2 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>
                    <?php echo $conn->query("SELECT COUNT(*) as count FROM `schedule_list` WHERE date(datetime_start) = '" . date("Y-m-d") . "'")->fetch_assoc()['count']; ?>
                </h3>
                <p>Today's Schedule</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-day"></i>
            </div>
            <a href="./?page=schedules" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Upcoming Events -->
    <div class="col-lg-2 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>
                    <?php echo $conn->query("SELECT COUNT(*) as count FROM `schedule_list` WHERE date(datetime_start) > '" . date("Y-m-d") . "'")->fetch_assoc()['count']; ?>
                </h3>
                <p>Upcoming Schedule</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <a href="./?page=schedules" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <!-- Cancelled Events -->
    <div class="col-lg-2 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>
                    <?php 
                    $cancelledCount = $conn->query("SELECT COUNT(*) as count FROM canceled_schedule")->fetch_assoc()['count'];
                    echo $cancelledCount;
                    ?>
                </h3>
                <p>Cancelled Schedule</p>
            </div>
            <div class="icon">
                <i class="fas fa-ban"></i>
            </div>
        </div>
    </div>
</div>
<h4>Notifications</h4>
<!-- Add Recent, Upcoming, cancelled and Today's Events -->
<div class="row">
    <!-- Recent Events -->
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h3 class="card-title">Recent Schedule</h3>
            </div>
            <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                <ul class="list-unstyled">
                    <?php
                    $recent_events = $conn->query("
                        SELECT sl.*, ah.room_name, ah.location 
                        FROM `schedule_list` sl 
                        JOIN `assembly_hall` ah 
                        ON sl.assembly_hall_id = ah.id 
                        WHERE date(datetime_start) < '" . date("Y-m-d") . "' 
                        ORDER BY datetime_start DESC LIMIT 5
                    ");
                    if ($recent_events->num_rows > 0):
                        while ($event = $recent_events->fetch_assoc()):
                    ?>
                    <li class="mb-3">
                        <strong><?php echo htmlspecialchars($event['room_name']); ?></strong><br>
                        Date: <?php echo htmlspecialchars(date('M d, Y h:i A', strtotime($event['datetime_start']))); ?><br>
                        Location: <?php echo htmlspecialchars($event['location']); ?>
                    </li>
                    <?php
                        endwhile;
                    else:
                        echo '<li>No recent events found.</li>';
                    endif;
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Today's Events -->
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header bg-warning text-white">
                <h3 class="card-title">Today's Schedule</h3>
            </div>
            <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                <ul class="list-unstyled">
                    <?php
                    $todays_events = $conn->query("
                        SELECT sl.*, ah.room_name, ah.location 
                        FROM `schedule_list` sl 
                        JOIN `assembly_hall` ah 
                        ON sl.assembly_hall_id = ah.id 
                        WHERE date(datetime_start) = '" . date("Y-m-d") . "' 
                        ORDER BY datetime_start ASC
                    ");
                    if ($todays_events->num_rows > 0):
                        while ($event = $todays_events->fetch_assoc()):
                    ?>
                    <li class="mb-3">
                        <strong><?php echo htmlspecialchars($event['room_name']); ?></strong><br>
                        Time: <?php echo htmlspecialchars(date('h:i A', strtotime($event['datetime_start']))); ?><br>
                        Location: <?php echo htmlspecialchars($event['location']); ?>
                    </li>
                    <?php
                        endwhile;
                    else:
                        echo '<li>No events today.</li>';
                    endif;
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Upcoming Events -->
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Upcoming Schedule</h3>
            </div>
            <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                <ul class="list-unstyled">
                    <?php
                    $upcoming_events = $conn->query("
                        SELECT sl.*, ah.room_name, ah.location 
                        FROM `schedule_list` sl 
                        JOIN `assembly_hall` ah 
                        ON sl.assembly_hall_id = ah.id 
                        WHERE date(datetime_start) > '" . date("Y-m-d") . "' 
                        ORDER BY datetime_start ASC LIMIT 5
                    ");
                    if ($upcoming_events->num_rows > 0):
                        while ($event = $upcoming_events->fetch_assoc()):
                    ?>
                    <li class="mb-3">
                        <strong><?php echo htmlspecialchars($event['room_name']); ?></strong><br>
                        Date: <?php echo htmlspecialchars(date('M d, Y h:i A', strtotime($event['datetime_start']))); ?><br>
                        Location: <?php echo htmlspecialchars($event['location']); ?>
                    </li>
                    <?php
                        endwhile;
                    else:
                        echo '<li>No upcoming events found.</li>';
                    endif;
                    ?>
                </ul>
            </div>
        </div>
    </div>

<!-- Canceled Events -->
<div class="col-lg-3">
    <div class="card">
        <div class="card-header bg-danger text-white">
            <h3 class="card-title">Cancelled Schedule</h3>
        </div>
        <div class="card-body" style="max-height: 300px; overflow-y: auto;">
            <ul class="list-unstyled">
                <?php
                // Query to fetch cancelled events with room_name and location directly from the table
                $cancelled_events = $conn->query("
                    SELECT 
                        cs.canceled_at,
                        cs.room_name AS room_name,
                        cs.location AS location,
                        JSON_UNQUOTE(JSON_EXTRACT(cs.schedule_data, '$.datetime_start')) AS cancelled_datetime_start,
                        JSON_UNQUOTE(JSON_EXTRACT(cs.schedule_data, '$.reserved_by')) AS reserved_by,
                        JSON_UNQUOTE(JSON_EXTRACT(cs.schedule_data, '$.schedule_remarks')) AS schedule_remarks
                    FROM `canceled_schedule` cs
                    WHERE cs.canceled_at IS NOT NULL
                    ORDER BY cs.canceled_at DESC
                ");

                if ($cancelled_events->num_rows > 0):
                    while ($event = $cancelled_events->fetch_assoc()):
                ?>
                <li class="mb-3">
                    <strong><?php echo htmlspecialchars($event['room_name']); ?></strong><br>
                    Reserved By: <?php echo htmlspecialchars($event['reserved_by']); ?><br>
                    Event Name: <?php echo htmlspecialchars($event['schedule_remarks']); ?><br>
                    Date Created: <?php echo htmlspecialchars(date('M d, Y h:i A', strtotime($event['cancelled_datetime_start']))); ?><br>
                    <span class="text-danger"><strong>Cancelled on: <?php echo htmlspecialchars(date('M d, Y h:i A', strtotime($event['canceled_at']))); ?></strong></span>
                </li>
                <?php
                    endwhile;
                else:
                    echo '<li>No cancelled events found.</li>';
                endif;
                ?>
            </ul>
        </div>
    </div>
</div>


</div>
