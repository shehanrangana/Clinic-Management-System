<template>
    <div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Queue Progress</h5>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                </div>
            </div>
        </div>
        <div class="card-deck text-center">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">PANEL 1</div>
                <div class="card-body">
                    <h1>1</h1>
                    <p class="card-text">Dr. R.A. Samaranayake</p>
                </div>
            </div>
            <div class="card text-white bg-info mb-3">
                <div class="card-header">PANEL 1</div>
                <div class="card-body">
                    <h1>2</h1>
                    <p class="card-text">Dr. R.A. Samaranayake</p>
                </div>
            </div>
            <div class="card text-white bg-info mb-3">
                <div class="card-header">PANEL 1</div>
                <div class="card-body">
                    <h1>3</h1>
                    <p class="card-text">Dr. R.A. Samaranayake</p>
                </div>
            </div>
            <div class="card text-white bg-info mb-3">
                <div class="card-header">PANEL 1</div>
                <div class="card-body">
                    <h1>4</h1>
                    <p class="card-text">Dr. R.A. Samaranayake</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    
</script>

<style>
.card {
    margin: 20px auto;
    border-radius: 0;
    font-family: 'Roboto', sans-serif!important;
}
.card-deck .card-body, .card-header {
    background: #0086c3;
    font-size: 18px;
}
.card-deck h1 {
    font-size: 78px;
    font-family: 'Yantramanav', sans-serif;
    color: #fff;
}
.card-deck p {
    font-size: 20px;
    border: #42a5f5 solid;
    border-width: 0.05rem;
}
</style>
