<template>
	<div class="row">
		<div class="col-sm-4"> </div>
		<div class="col-sm-4">
			<div class="list-group mb-10">
				<draggable v-model="mutableItems" @end="onMove">
					<transition-group>
						<a href="#" v-for="item in mutableItems" class="list-group-item list-group-item-success" :key="item.id">{{ item.id }}. {{ item.name }}</a>
					</transition-group>
				</draggable>
			</div>
			<button class="btn btn-primary" @click="saveOrder">Save</button>
		</div>
		<div class="col-sm-4"> </div>
	</div>
</template>

<script>
import draggable from 'vuedraggable';
    export default {
		components: {
            draggable,
        },
		data() {
			return {
				mutableItems: this.items, /* you should not use the same name for your prop and data */
			}
			
		},
        mounted() {
            console.log('Component mounted.')
        },
		methods: {
			saveOrder() {
				let postData = [];
				this.mutableItems.forEach((item, key) => {
					postData[key] = {'id':item.id, 'order':key};
				});
				window.axios.post('/reOrder', postData)
				.then(function(response) {
					//console.log(response.data);
				})
				.catch(function(error) {
					//console.log(error.response.data);
				});
			},
			onMove(e) {
				//Invoked when move ends
			}
		},
		props: ['items'],
    }
</script>
