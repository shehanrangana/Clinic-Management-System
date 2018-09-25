<template>
    <div>
        <p v-bind:class="{invisible: hasError}">please fill all the fields<p>
        <form>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" v-model="newItem.name">
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" class="form-control" id="age" name="age" placeholder="Enter age" v-model="newItem.age">
            </div>
            <div class="form-group">
                <label for="profession">Profession</label>
                <input type="text" class="form-control" id="profession" name="profession" placeholder="Enter profession" v-model="newItem.profession">
            </div>
            
            <button type="submit" class="btn btn-primary" @click.prevent="createItem()">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                newItem: {'name': '', 'age': '', 'profession': ''},
                hasError: true
            }
        },

        methods: {
            createItem: function createItem() {
                var input = this.newItem;
                if(input['name'] == '' || input['age'] == '' || input['profession'] == ''){
                    this.hasError = false
                }else{
                    this.hasError = true;
                    axios.post('/storeItem', input).then(function (response){

                    });
                }
            }
        }
    }
</script>