new DataTable("#example", {
  responsive: true,
  ajax: {
    url: "data_list.php",
    dataSrc: "",
  },
  columns: [
    { title: "#", data: "id" },
    { title: "U ID", data: "unique_id" },
    { title: "TARIKH DAFTAR", data: "tarikh" },
    { title: "NAMA", data: "nama" },
    { title: "EMAIL", data: "email" },
    { title: "PHONE NO", data: "phoneno" },
    { title: "NO K/P", data: "nokp" },
    { title: "ALAMAT PEMASANGAN", data: "alamatPemasangan" },
    { title: "ALAMAT S/MENYURAT", data: "alamatBill" },
    { title: "PAKEJ", data: "pid" },
    { title: "TARIKH PEMASANGAN", data: "tarikhWaktu" },
    { title: "SIGNATURE", data: "signa_c" },
    { title: "IMG BILL", data: "imgBill" },
    { title: "FRONT IC", data: "imgKpD" },
    { title: "BACK IC", data: "imgKpB" },
    { title: "STATUS", data: "status" },
    { title: "PHONE NO EXT", data: "phonenoTambahan" },
    { title: "CATATAN", data: "catatan" },
  ],
});
