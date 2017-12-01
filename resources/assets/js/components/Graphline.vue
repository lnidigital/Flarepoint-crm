<template>
    <canvas width="730" height="240" ref="canvasline"></canvas>
</template>

<script>
import Chart from 'chart.js';

    export default {
        props: ['title','values', 'labels', 'valuesextra'],
        methods: {
            render(data)
            {
                this.Chart = new Chart(this.$refs.canvasline.getContext('2d'), {
                    type: 'line',
                    data: {
                    labels: this.labels,
                    datasets: [
                        {
                            label: this.title,
                            borderColor: "rgb(58,72,92)",
                            data: this.values
                        },
                        
                    ]
                    },
                    options: {
                        responsive: true,
                        
                    },
                });
            },
          },
            mounted() {
                this.render();
            },
        };
</script>