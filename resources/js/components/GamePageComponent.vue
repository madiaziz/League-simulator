<template>
  <v-container>
    <v-progress-linear
      :active="isLoading"
      indeterminate
      color="primary"
    ></v-progress-linear>
    <v-card class="mt-5 shadow-lg p-3 mb-5 bg-white rounded" outlined>
      <v-card-title>
        <div class="w-100">Premier league simulator</div>
        <v-btn
          class="m-2"
          depressed
          color="secondary"
          @click="addTeams()"
          small
          outlined
          >Add teams</v-btn
        >
        <v-btn
          class="m-2"
          depressed
          color="error"
          @click="removeTeams()"
          small
          outlined
          >Remove teams</v-btn
        >
      </v-card-title>
    </v-card>
    <v-row>
      <v-col cols="12" md="9">
        <v-row>
          <v-col cols="12" md="7">
            <v-card class="mt-5 shadow-lg p-3 mb-5 bg-white rounded" outlined>
              <div class="h4 text-center">League Table</div>
              <v-simple-table dense>
                <template v-slot:default>
                  <thead>
                    <tr>
                      <th class="text-left">Team</th>
                      <th class="text-left">P</th>
                      <th class="text-left">W</th>
                      <th class="text-left">D</th>
                      <th class="text-left">L</th>
                      <th class="text-left">GD</th>
                      <th class="text-left">Pts</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(team, index) in leagueTableData"
                      :key="'team-' + index"
                      :class="
                        isFinal && index == 0 ? 'bg-secondary text-white' : ''
                      "
                    >
                      <td>{{ team.name }}</td>
                      <td>{{ team.p }}</td>
                      <td>{{ team.w }}</td>
                      <td>{{ team.d }}</td>
                      <td>{{ team.l }}</td>
                      <td>{{ team.gd }}</td>
                      <td>{{ team.pts }}</td>
                    </tr>
                  </tbody>
                </template>
              </v-simple-table>
              <v-card-actions>
                <template v-if="!isFinal">
                  <v-btn
                    depressed
                    outlined
                    color="primary"
                    @click="playAll(getNextWeek)"
                  >
                    Play all
                  </v-btn>
                  <v-spacer></v-spacer>
                  <v-btn
                    outlined
                    :disabled="isLoading"
                    depressed
                    color="primary"
                    @click="playNextWeek(getNextWeek)"
                  >
                    Next week
                  </v-btn>
                </template>
                <template v-else>
                  <v-btn
                    :disabled="isLoading"
                    outlined
                    depressed
                    color="primary"
                    @click="restart()"
                  >
                    Restart
                  </v-btn>
                </template>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col cols="12" md="5">
            <v-card
              v-for="(week, index) in gameTableData"
              :key="'game-' + index"
              class="mt-5 shadow-lg p-3 mb-5 bg-white rounded"
              outlined
            >
              <div class="h4 text-center">Match Results</div>
              <div class="h5 text-center">
                {{ index }}{{ getNextWeekSuffix(index) }} Week Match Results
              </div>
              <v-simple-table dense>
                <template v-slot:default>
                  <tbody>
                    <tr v-for="(game, index) in week" :key="'game-' + index">
                      <td>{{ game.home_team.name }}</td>
                      <td class="text-center">
                        {{ game.game.home_goals }} - {{ game.game.away_goals }}
                      </td>
                      <td class="text-right">
                        {{ game.away_team.name }}
                      </td>
                    </tr>
                  </tbody>
                </template>
              </v-simple-table>
            </v-card>
          </v-col>
        </v-row>
      </v-col>
      <v-col cols="12" md="3">
        <v-card
          v-if="predictionTableData.length"
          class="mt-5 shadow-lg p-3 mb-5 bg-white rounded"
          outlined
        >
          <div class="h4 text-center">Match Predictions</div>
          <div class="h5 text-center">
            {{ getNextWeek }}{{ getNextWeekSuffix(getNextWeek) }} week
            predictions of championship
          </div>
          <v-simple-table dense>
            <template v-slot:default>
              <tbody>
                <tr
                  v-for="(team, index) in predictionTableData"
                  :key="'pred-' + index"
                >
                  <td>{{ team.team }}</td>
                  <td class="text-right">{{ team.prediction }}%</td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
  props: ["data"],
  mounted() {
    this.getTablesData();
  },
  methods: {
    ...mapActions("game", [
      "getTablesData",
      "playAll",
      "playNextWeek",
      "restart",
      "addTeams",
      "removeTeams",
    ]),
    getNextWeekSuffix(week) {
      switch (+week) {
        case 1:
          return "st";
        case 2:
          return "nd";
        case 3:
          return "rd";
        case week > 3:
          return "th";
        default:
          return "th";
      }
    },
  },
  computed: {
    ...mapGetters("game", [
      "leagueTableData",
      "gameTableData",
      "predictionTableData",
      "nextWeek",
      "isFinal",
      "isLoading",
    ]),
    getNextWeek() {
      return this.nextWeek;
    },
  },
};
</script>
