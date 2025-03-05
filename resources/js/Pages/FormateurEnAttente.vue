<template>
    <div>
      <h1>Formateurs en attente de validation</h1>
      <div v-if="formateurs.length === 0">
        <p>Aucun formateur en attente.</p>
      </div>
      <div v-else>
        <table class="table">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Email</th>
              <th>Spécialité</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="formateur in formateurs" :key="formateur.id">
              <td>{{ formateur.first_name }} {{ formateur.last_name }}</td>
              <td>{{ formateur.email }}</td>
              <td>{{ formateur.speciality }}</td>
              <td>
                <button @click="validerFormateur(formateur.id)" class="btn btn-success">Valider</button>
                <button @click="rejeterFormateur(formateur.id)" class="btn btn-danger">Rejeter</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      formateurs: Array,
    },
    methods: {
      async validerFormateur(formateurId) {
        // Appeler une API pour changer le statut du formateur
        try {
          await axios.post(`/api/formateurs/${formateurId}/valider`);
          // Recharger la page ou mettre à jour les données
          this.$inertia.reload();
        } catch (error) {
          console.error("Erreur lors de la validation du formateur", error);
        }
      },
      async rejeterFormateur(formateurId) {
        // Appeler une API pour changer le statut du formateur
        try {
          await axios.post(`/api/formateurs/${formateurId}/rejeter`);
          // Recharger la page ou mettre à jour les données
          this.$inertia.reload();
        } catch (error) {
          console.error("Erreur lors du rejet du formateur", error);
        }
      }
    }
  };
  </script>
  
  <style scoped>
  .table {
    width: 100%;
    border-collapse: collapse;
  }
  .table th, .table td {
    padding: 8px;
    text-align: left;
    border: 1px solid #ddd;
  }
  </style>
  