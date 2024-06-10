<link rel="stylesheet" href="css/style.css">

<?php
use yii\data\ArrayDataProvider;
use app\models\Notes;
use yii\widgets\ListView;
use yii\grid\GridView;

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

use yii\jui\AutoComplete;

?>

<?php
// Массив с русскими названиями месяцев
$russianMonths = [
    'January' => 'Январь',
    'February' => 'Февраль',
    'March' => 'Март',
    'April' => 'Апрель',
    'May' => 'Май',
    'June' => 'Июнь',
    'July' => 'Июль',
    'August' => 'Август',
    'September' => 'Сентябрь',
    'October' => 'Октябрь',
    'November' => 'Ноябрь',
    'December' => 'Декабрь',
];

// Получаем текущий месяц на английском языке
$currentMonthEnglish = date('F');
// Переводим его на русский язык, если есть соответствующее значение в массиве
$currentMonthRussian = isset($russianMonths[$currentMonthEnglish]) ? $russianMonths[$currentMonthEnglish] : $currentMonthEnglish;
?>



<div class="container">

    <h1 class="h1-diary">Настроение за <?= $currentMonthRussian ?></h1>
    <?php if (isset($message)): ?>
    <p><?= $message ?></p>
<?php endif; ?>
    <div class="cont-2">
    
    <div class="list-container">
        <?php
        
        $models = [];
        foreach ($statistic as $item) {
            $model = new Notes(); 
            $model->attributes = $item; 
            $models[] = $model; 
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $models,
        ]);

        
        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_listItem', 
            'layout' => '{items}', 
        ]);
   
        ?>

    </div>
    <div class="chart-container">
        
        <canvas id="pieChart" width="500px" height="500px"></canvas>
    </div>
    </div>
</div>









<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var labels = <?= json_encode(array_column($statistic, 'notes.mood.mood')) ?>;
    var data = <?= json_encode(array_column($statistic, 'frequency')) ?>;
    var ctx = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: [
                    'rgba(192, 23, 28, 0.7)',  
                    'rgba(252, 62, 90, 0.7)',  
                    'rgba(255, 125, 129, 0.7)', 
                    'rgba(255, 168, 175, 1)', 
                    'rgba(255, 144, 67, 0.7)', 

    
                ],
                borderColor: [
                    'rgba(192, 23, 28, 0.7)',  
                    'rgba(252, 62, 90, 0.7)', 
                    'rgba(255, 125, 129, 0.7)',
                    'rgba(255, 168, 175, 1)', 
                    'rgba(255, 144, 67, 0.7)', 
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            legend: {
                display: true,
                position: 'left', 
                labels: {
                    fontSize: 12,
                    fontStyle: 'bold', 
                    generateLabels: function(chart) {
                        var data = chart.data;
                        if (data.labels.length && data.datasets.length) {
                            return data.labels.map(function(label, i) {
                                var value = data.datasets[0].data[i];
                                return {
                                    text: label + ': ' + value,
                                    fillStyle: data.datasets[0].backgroundColor[i],
                                    hidden: isNaN(value), 
                                    index: i
                                };
                            });
                        }
                        return [];
                    }
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = data.labels[tooltipItem.index];
                        var value = data.datasets[0].data[tooltipItem.index];
                        return label + ': ' + value;
                    }
                }
            }
        }
    });
</script>

<style>
    .cont-2 {
        display: flex; /* Использовать flexbox-раскладку */
        justify-content: space-between; /* Равномерно распределить элементы */
        flex-wrap: wrap;
        margin-top:37px;
    }


    #pieChart{
        width: 400px !important;
    /* height: 400px !important; */
    max-width: 100%;
    max-height: 100%;
    }
    .empty{
        display: none;
    }

</style>
