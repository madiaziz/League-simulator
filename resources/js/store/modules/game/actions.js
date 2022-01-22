import { commitTableDataChanges } from '../../helpers';

export const getTablesData = async ({ commit }) => {
    //get data from api
    commit('setIsLoading', true);
    const { data } = await axios.get('/api/weeks/current');
    commitTableDataChanges({ data, commit });
}

export const playNextWeek = async ({ commit }, week) => {
    //get data from api
    commit('setIsLoading', true);
    const { data } = await axios.post(`/api/weeks/${week + 1}/next`, { _method: 'put' });
    commitTableDataChanges({ data, commit });
}

export const playAll = async ({ commit }, week) => {
    //get data from api
    commit('setIsLoading', true);
    const { data } = await axios.post(`/api/weeks/${week + 1}/last`, { _method: 'put' });
    commitTableDataChanges({ data, commit });
}

export const restart = async ({ commit }) => {
    //get data from api
    commit('setIsLoading', true);
    const { data } = await axios.post(`/api/weeks/restart`, { _method: 'put' });
    commitTableDataChanges({ data, commit });
}

export const addTeams = async ({ commit }) => {
    commit('setIsLoading', true);
    const { data } = await axios.post(`/api/teams/add`, { _method: 'put' });
    commitTableDataChanges({ data, commit });
}

export const removeTeams = async ({ commit }) => {
    commit('setIsLoading', true);
    const { data } = await axios.post(`/api/teams/remove`, { _method: 'put' });
    commitTableDataChanges({ data, commit });
}