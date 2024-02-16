
import pandas as pd

titanic = pd.read_csv('titanic.csv', sep=',', encoding='latin-1')
print(titanic)

titanic['Edad'] = titanic['Edad'].astype(str).str.replace('1', 'adulto').str.replace('0', 'niño')
titanic['Clase'] = titanic['Clase'].astype(str).str.replace('0', 'tripulacion')
titanic['Clase'] = titanic['Clase'].astype(str).str.replace('1', 'primera').str.replace('2', 'segunda').str.replace('3', 'tercera')
titanic['Sexo'] = titanic['Sexo'].astype(str).str.replace('1', 'hombre').str.replace('0', 'mujer')
titanic['Sobrevivió?'] = titanic['Sobrevivió?'].astype(str).str.replace('1', 'si').str.replace('0', 'no')

print(titanic)
#titanic.to_csv('titanic2.csv', sep=',', encoding='latin-1', index=False)