<div id="{{ $id }}">
    <div class="chart-pie pt-4 pb-2">
        <canvas class="item-terlaris-chart-canvas"></canvas>
    </div>
    <div class="mt-4 text-center small item-terlaris-row">
        
    </div>
</div>

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js" integrity="sha512-hZf9Qhp3rlDJBvAKvmiG+goaaKRZA6LKUO35oK6EsM0/kjPK32Yw7URqrq3Q+Nvbbt8Usss+IekL7CRn83dYmw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    class ItemTerlarisPie{
        constructor(selector){
            this._element = document.getElementById(selector);
            this.item_row = this._element.querySelector(".item-terlaris-row");
            this.chart_canvas = this._element.querySelector(".item-terlaris-chart-canvas");

            this._chart = null;
            this.terlaris_data = [];
        }

        load_data(range){
            
            fetch("/api/menus/terlaris/"+range, {
                headers: {
                    "Content-type" : "application/json",
                    "Accept" : "application/json, text-plain, */*",
                    "X-CSRF-Token" : "{{ csrf_token() }}"
                },
                method: "get",
                credentials:"same-origin"
            })
            .then((response)=>{
                return response.text()
            })
            .then((raw_data)=>{
                let data = JSON.parse(raw_data);
                this.terlaris_data = data['data'];
                
                let whole_row_html = "";
                let total = 0;
                this.terlaris_data.forEach(menu => {
                    whole_row_html += "<span class='mr-2'><i class='fas fa-circle text-primary'>"
                    whole_row_html += menu[1];
                    total += menu[2];
                    whole_row_html += "</i></span>";
                });

                if (total > 0){
                    this.item_row.innerHTML = whole_row_html;
                    this.make_pie();
                }else{
                    if (this._chart){
                        this._chart.destroy();
                    }
                    this.item_row.innerHTML = "Menu tidak ada transaksi dalam jangkauan ini."
                }
            })
        }
        
        make_pie(){
            let labels = [];
            let datas = [];

            this.terlaris_data.forEach((menu)=>{
                labels.push(menu[1]);
                datas.push(menu[2]);
            })

            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#858796';

            // Pie Chart Example
            if (this._chart){
                this._chart.destroy();
            }
            this._chart = new Chart(this.chart_canvas, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: datas,
                        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    },
                    legend: {
                    display: false
                    },
                    cutoutPercentage: 80,
                },
            });
        }
    }
</script>
@endpush