<div id="tabs-1">
    <?php 
        $all_stocks = $wpdb->get_results( "SELECT item_name, cat_name, stock_count FROM {$wpdb->base_prefix}stock_tbl", ARRAY_A );
        // tape, gauze, tubes

        $labels = $stock_count = [];
        foreach( $all_stocks as $single ) {
            $labels[] = $single['item_name'];
            $stock_count[] = $single['stock_count'];
        }

        $labels_json = json_encode($labels);
        $stock_count_json = json_encode($stock_count);
    ?>

    <canvas id="inventory-chart" width="400" height="200"></canvas>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('inventory-chart').getContext('2d');
                                    
            var months = ['January', 'February', 'March', 'April', 'May', 'June'];

            function getRandomNumbers(items) {
                let outputNumbers = [];
                for( let i = 0; i < items; i++ ) {
                    outputNumbers.push(Math.floor(Math.random() * 100) + 1);
                }
                return outputNumbers;
            }
            
            var chart = new Chart(ctx, {
                // type: 'bar',
                type: 'pie',
                data: {
                    labels: <?php echo $labels_json?>,
                    datasets: [{
                        data: <?php echo $stock_count_json?>
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Stock Chart'
                        }
                    }
                },	
            });
        });
    </script>
</div>