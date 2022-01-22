export const commitTableDataChanges = ({ data, commit, }) => {
    commit('setLeagueTableData', data.leagueTableData);
    commit('setGameTableData', data.gameTableData);
    commit('setPredictionTableData', data.predictionTableData);
    commit('setNextWeek', data.week);
    commit('setIsFinal', data.is_final);
    commit('setIsLoading', false);
};