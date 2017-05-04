const state= {
	packs:[],
	categories:[]
}

const mutations={

	SET_INITIAL_DATA (state,data){

		state.packs=data.packs
		
		state.categories=data.categories
     }

}

const actions= {
setInitialData: ({commit},data) => {
		commit('SET_INITIAL_DATA',data)
	}

}

export default {
 state, mutations, actions
}