import numpy as np
import pandas as pd

print("=========================================================")
print("LANGKAH 3: KOMPUTASI DEVIASI RATA-RATA (MEAN DEVIATION)")
print("=========================================================")

# Mean Berkelompok hasil Laporan 3
mean_kelompok = 218385.664026

# Rekonstruksi tabel distribusi frekuensi RAID Storage Array Disk Latency
data_tabel = {
    'Rentang Kelas': [
        '(-2981.306, 298130.567]',
        '(298130.567, 596261.134]',
        '(596261.134, 894391.702]',
        '(894391.702, 1192522.269]',
        '(1192522.269, 1490652.836]',
        '(1490652.836, 1788783.403]',
        '(1788783.403, 2086913.971]',
        '(2086913.971, 2385044.538]',
        '(2385044.538, 2683175.105]',
        '(2683175.105, 2981305.672]'
    ],

    'Titik Tengah (xi)': [
        (-2981.306 + 298130.567) / 2,
        (298130.567 + 596261.134) / 2,
        (596261.134 + 894391.702) / 2,
        (894391.702 + 1192522.269) / 2,
        (1192522.269 + 1490652.836) / 2,
        (1490652.836 + 1788783.403) / 2,
        (1788783.403 + 2086913.971) / 2,
        (2086913.971 + 2385044.538) / 2,
        (2385044.538 + 2683175.105) / 2,
        (2683175.105 + 2981305.672) / 2
    ],

    'Frekuensi (fi)': [
        79398,
        7881,
        2689,
        1202,
        449,
        160,
        168,
        132,
        42,
        10
    ]
}

df_distribusi = pd.DataFrame(data_tabel)

# Total sampel
total_n = df_distribusi['Frekuensi (fi)'].sum()

# Menghitung |xi - Xbar|
df_distribusi['|xi - Xbar|'] = np.abs(
    df_distribusi['Titik Tengah (xi)'] - mean_kelompok
)

# Menghitung fi × |xi - Xbar|
df_distribusi['fi_times_mutlak'] = (
    df_distribusi['Frekuensi (fi)']
    * df_distribusi['|xi - Xbar|']
)

# Menghitung Mean Deviation
total_fi_mutlak = df_distribusi['fi_times_mutlak'].sum()

nilai_md = total_fi_mutlak / total_n

print(f"Total Sampel (n) : {total_n}")
print(f"Deviasi Rata-Rata (MD) : {nilai_md:.6f}")

print("\nTABEL PERHITUNGAN DEVIASI RATA-RATA")
display(df_distribusi)