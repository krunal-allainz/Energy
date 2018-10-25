import * as types from '../mutation-types'
import _ from 'lodash'
import user from '../../api/users'
import moment from 'moment'

// initial state
const state = {
	'bodypartsId':0,
  'bodypartsPage':''
}


// actions
const actions = {
  SetBodypartsId ({commit},bodypartsId) {
    commit(types.SET_BODYPARTS_ID, bodypartsId)
  },
  SetBodypartsPage ({commit},bodypartsPage) {
    commit(types.SET_BODYPARTS_PAGE, bodypartsPage)
  },
 }
// mutations
const mutations = {
	[types.SET_BODYPARTS_ID] (state, bodypartsId) {
    state.bodypartsId = bodypartsId
  },
  [types.SET_BODYPARTS_PAGE] (state, bodypartsPage) {
    state.bodypartsPage = bodypartsPage
  },
}

export default {
  state,
  // getters,
  actions,
  mutations
}