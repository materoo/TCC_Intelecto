import matplotlib.pyplot as plt
import pandas as pd
import psycopg2
#
import os
#
#
# # from ipywidgets import interact_manual, widgets, VBox, HBox
# # import ipywidgets as widgets
from flask import Flask, render_template, request, redirect, url_for, session
import io
import base64
# import pandas as pd
# db_config = {
#     "dbname": "projetoscti6",
#     "user": "projetoscti6",
#     "password": "eq473a483",
#     "host": "pgsql21-farm10.kinghost.net",
#     "port": "5432",
# }
#
#
# def fetch_table_data(table_name):
#     conn = psycopg2.connect(**db_config)
#     cursor = conn.cursor()
#
#     # Substitua 'tabela' pelo nome da tabela da qual você deseja receber os dados
#     query = f"SELECT * FROM {table_name};"
#     cursor.execute(query)
#
#     # Recupere todos os registros da consulta
#     data = cursor.fetchall()
#
#     conn.close()
#
#     return data
#
#
# materias = fetch_table_data("materias")
# nomes_das_colunas_materias = ["nome_materia", "created_at", "updated_at"]
#
# assuntos = fetch_table_data("assuntos")
# nomes_das_colunas_assuntos = [
#     "nome_assunto",
#     "carga_horaria",
#     "fk_materia",
#     "created_at",
#     "updated_at",
# ]
#
# alternativas = fetch_table_data("alternativas")
# nomes_das_colunas_alternativas = [
#     "letra",
#     "descricao_alternativa",
#     "imagem_alternativa",
#     "correta",
#     "fk_id_exercicio",
#     "created_at",
#     "updated_at",
# ]
# exercicios = fetch_table_data("exercicios")
# nomes_das_colunas_exercicios = [
#     "id_exercicio",
#     "descricao_exercicio",
#     "imagem_exercicio",
#     "ano_exercicio",
#     "vestibular",
#     "fk_assunto",
#     "fk_materia",
#     "created_at",
#     "updated_at",
# ]
#
# respostas = fetch_table_data("resposta_alunos")
# nomes_das_colunas_respostas = [
#     "fk_id_exercicio",
#     "letra_respondida",
#     "created_at",
#     "updated_at",
# ]
# alunos = fetch_table_data("alunos")
# nomes_das_colunas_alunos = [
#     "cpf_aluno",
#     "rg_aluno",
#     "nome_aluno",
#     "email_aluno",
#     "celular_aluno",
#     "escola_aluno",
#     "serie_aluno",
#     "imagem_aluno",
#     "senha_aluno",
#     "created_at",
#     "updated_at",
# ]
# dt_alunos = pd.DataFrame(alunos, columns=nomes_das_colunas_alunos)
# dt_exercicios = pd.DataFrame(exercicios, columns=nomes_das_colunas_exercicios)
# dt_alternativas = pd.DataFrame(alternativas, columns=nomes_das_colunas_alternativas)
# dt_respostas = pd.DataFrame(respostas, columns=nomes_das_colunas_respostas)
# dt_materias = pd.DataFrame(materias, columns=nomes_das_colunas_materias)
# dt_assuntos = pd.DataFrame(assuntos, columns=nomes_das_colunas_assuntos)
#
# # Exemplos de dados para a tabela 'materias'
# dados_materias = []
# for i in range(20):
#     dados_materias.append(
#         {
#             "nome_materia": f"Matéria {i + 1}",
#             "created_at": "2023-08-10",
#             "updated_at": "2023-08-10",
#         }
#     )
#
# # Exemplos de dados para a tabela 'assuntos'
# dados_assuntos = []
# for i in range(20):
#     dados_assuntos.append(
#         {
#             "nome_assunto": f"Assunto {i + 1}",
#             "carga_horaria": 10 + (i % 5),
#             "fk_materia": f"Matéria {i % 10 + 1}",
#             "created_at": "2023-08-10",
#             "updated_at": "2023-08-10",
#         }
#     )
#
# # Exemplos de dados para a tabela 'exercicios'
# dados_exercicios = []
# for i in range(20):
#     dados_exercicios.append(
#         {
#             "id_exercicio": i + 1,
#             "descricao_exercicio": f"Exercício {i + 1}",
#             "imagem_exercicio": f"exercicio_{i + 1}.png",
#             "ano_exercicio": 2023,
#             "vestibular": "ENEM" if i % 2 == 0 else "FUVEST",
#             "fk_assunto": f"Assunto {i % 10 + 1}",
#             "fk_materia": f"Matéria {i % 10 + 1}",
#             "created_at": "2023-08-10",
#             "updated_at": "2023-08-10",
#         }
#     )
#
# # Exemplos de dados para a tabela 'alternativas'
# dados_alternativas = []
# for i in range(20):
#     dados_alternativas.append(
#         {
#             "letra": chr(65 + i),  # Letra A, B, C, ...
#             "descricao_alternativa": f"Resposta {chr(65 + i)}",
#             "imagem_alternativa": f"imagem_{chr(65 + i)}.png",
#             "correta": i % 2 == 0,  # Alternando entre corretas e incorretas
#             "fk_id_exercicio": (i % 10) + 1,
#             "created_at": "2023-08-10",
#             "updated_at": "2023-08-10",
#         }
#     )
#
# # Exemplos de dados para a tabela 'resposta_alunos'
# dados_respostas = []
# for i in range(20):
#     dados_respostas.append(
#         {
#             "fk_id_exercicio": (i % 10) + 1,
#             "letra_respondida": chr(65 + (i % 4)),  # A, B, C, D em sequência
#             "created_at": "2023-08-10",
#             "updated_at": "2023-08-10",
#         }
#     )
#
# # Exemplos de dados para a tabela 'alunos'
# dados_alunos = []
# for i in range(20):
#     cpf_base = 12345678900 + i
#     dados_alunos.append(
#         {
#             "cpf_aluno": f"{cpf_base + i:011d}",  # CPF fictício
#             "rg_aluno": f"{1000000 + i + 1}",  # RG fictício
#             "nome_aluno": f"Aluno {i + 1}",
#             "email_aluno": f"aluno{i + 1}@example.com",
#             "celular_aluno": f"98765432{i + 1:02d}",
#             "escola_aluno": f"Escola {chr(65 + (i % 5))}",
#             "serie_aluno": f"{i % 5 + 1}º ano",
#             "imagem_aluno": f"aluno_{i + 1}.png",
#             "senha_aluno": f"senha{i + 1}",
#             "created_at": "2023-08-10",
#             "updated_at": "2023-08-10",
#         }
#     )
#
# # Convertendo os exemplos de dados em DataFrames
# df_materias = pd.DataFrame(dados_materias)
# df_assuntos = pd.DataFrame(dados_assuntos)
# df_exercicios = pd.DataFrame(dados_exercicios)
# df_alternativas = pd.DataFrame(dados_alternativas)
# df_respostas = pd.DataFrame(dados_respostas)
# df_alunos = pd.DataFrame(dados_alunos)
#
#
# df_respostas.rename(columns={"fk_id_exercicio": "id_exercicio"}, inplace=True)
# df_alternativas.rename(columns={"fk_id_exercicio": "id_exercicio"}, inplace=True)
# # df_respostas
#
# respostas_exercicios = pd.merge(df_respostas, df_exercicios, on="id_exercicio")
# all_response = pd.merge(respostas_exercicios, df_alternativas, on="id_exercicio")
#
# all_response.drop(
#     columns=[
#         "created_at_x",
#         "updated_at_x",
#         "descricao_exercicio",
#         "imagem_exercicio",
#         "created_at_y",
#         "updated_at_y",
#         "descricao_alternativa",
#         "imagem_alternativa",
#         "created_at",
#         "updated_at",
#     ],
#     inplace=True,
# )
#
# all_response["correta"] = False
# filtro = all_response["letra"] == all_response["letra_respondida"]
# all_response.loc[filtro, "correta"] = True
# all_response_2 = all_response
#
#
# def erros_acertos_materia(all_response):
#     #     all_response_aux=all_response[all_response['fk_materia']==materia]
#     all_response = all_response_2
#     all_response_certo = all_response[all_response["correta"] == True]
#     contagem_certa = all_response_certo["fk_materia"].value_counts()
#     contagem_certa = contagem_certa.reset_index()
#     contagem_certa.rename(columns={"index": "materia"}, inplace=True)
#
#     all_response_errado = all_response[all_response["correta"] == False]
#     contagem_errada = all_response_errado["fk_materia"].value_counts()
#     contagem_errada = contagem_errada.reset_index()
#     contagem_errada.rename(columns={"index": "materia"}, inplace=True)
#     contagem = pd.merge(contagem_certa, contagem_errada, on="materia", how="outer")
#     contagem = contagem.fillna(0)
#
#     plt.plot(contagem["materia"], contagem["fk_materia_x"], "-")
#     plt.plot(contagem["materia"], contagem["fk_materia_y"], "-")
#     plt.xticks(fontsize=7)
#
#
# def erros_acertos_vestibular(vestibular):
#     all_response = all_response_2
#     all_response_certo = all_response[all_response["correta"] == True]
#     all_response_certo = all_response_certo[
#         all_response_certo["vestibular"] == vestibular
#     ]
#     contagem_certa = all_response_certo["fk_materia"].value_counts()
#     contagem_certa = contagem_certa.reset_index()
#     contagem_certa.rename(columns={"index": "materia"}, inplace=True)
#
#     all_response_errado = all_response[all_response["correta"] == False]
#     all_response_errado = all_response_errado[
#         all_response_errado["vestibular"] == vestibular
#     ]
#     contagem_errada = all_response_errado["fk_materia"].value_counts()
#     contagem_errada = contagem_errada.reset_index()
#     contagem_errada.rename(columns={"index": "materia"}, inplace=True)
#     contagem = pd.merge(contagem_certa, contagem_errada, on="materia", how="outer")
#     contagem = contagem.fillna(0)
#
#     plt.plot(contagem["materia"], contagem["fk_materia_x"], "-")
#     plt.plot(contagem["materia"], contagem["fk_materia_y"], "-")
#     plt.xticks(fontsize=7)
#
#
# def erros_acertos_ano(fig, ax, vestibular, ano_i, ano_f):
#     all_response = all_response_2
#     all_response = all_response[all_response["vestibular"] == vestibular]
#     all_response = all_response[all_response["ano_exercicio"] >= ano_i]
#     all_response = all_response[all_response["ano_exercicio"] < ano_f]
#
#     all_response_certo = all_response[all_response["correta"] == True]
#     contagem_certa = all_response_certo["fk_materia"].value_counts()
#     contagem_certa = contagem_certa.reset_index()
#     contagem_certa.rename(columns={"index": "materia"}, inplace=True)
#
#     all_response_errado = all_response[all_response["correta"] == False]
#     contagem_errada = all_response_errado["fk_materia"].value_counts()
#     contagem_errada = contagem_errada.reset_index()
#     contagem_errada.rename(columns={"index": "materia"}, inplace=True)
#     contagem = pd.merge(contagem_certa, contagem_errada, on="materia", how="outer")
#     contagem = contagem.fillna(0)
#
#     # Plotar o gráfico nos eixos fornecidos
#     ax.plot(contagem["materia"], contagem["fk_materia_x"], "-")
#     ax.plot(contagem["materia"], contagem["fk_materia_y"], "-")
#     ax.set_xticks(contagem["materia"])
#     ax.set_xticklabels(contagem["materia"], fontsize=7)
#
#     # Definir rótulos e título para o gráfico
#     ax.set_xlabel("Matéria")
#     ax.set_ylabel("Quantidade")
#     ax.set_title(f"Erros e acertos por matéria ({vestibular} {ano_i}-{ano_f})")


# ... (resto do código) ...


#     plt.plot(range(1,11), valores2,'*--' )
#     plt.plot(range(1,11), valores3, 'v-.' )

import pandas as pd
import numpy as np
import matplotlib
import psycopg2
from psycopg2 import sql
from psycopg2.extras import RealDictCursor
import time
import matplotlib.pyplot as plt
from ipywidgets import interact_manual, widgets, VBox, HBox
import ipywidgets as widgets
from flask import Flask
import random
from datetime import datetime, timedelta

db_config = {
    'dbname': 'projetoscti6',
    'user': 'projetoscti6',
    'password': 'eq473a483',
    'host': 'pgsql21-farm10.kinghost.net',
    'port': '5432',
}

def fetch_table_data(table_name):
    conn = psycopg2.connect(**db_config)
    cursor = conn.cursor()

    # Substitua 'tabela' pelo nome da tabela da qual você deseja receber os dados
    query = f"SELECT * FROM {table_name};"
    cursor.execute(query)

    # Recupere todos os registros da consulta
    data = cursor.fetchall()

    conn.close()

    return data


# materias=fetch_table_data('materias')
nomes_das_colunas_materias=['nome_materia','created_at','updated_at']
#
# assuntos=fetch_table_data('assuntos')
nomes_das_colunas_assuntos=['nome_assunto','carga_horaria','fk_materia','created_at','updated_at']
#
# alternativas=fetch_table_data('alternativas')
nomes_das_colunas_alternativas=['letra','descricao_alternativa','imagem_alternativa', 'correta','fk_id_exercicio','created_at','updated_at']
# exercicios=fetch_table_data('exercicios')
nomes_das_colunas_exercicios = [
    "id_exercicio",
    "descricao_exercicio",
    "imagem_exercicio",
    "ano_exercicio",
    "vestibular",
    "fk_assunto",
    "fk_materia",
    "created_at",
    "updated_at"
]
#
# respostas=fetch_table_data('resposta_alunos')
nomes_das_colunas_respostas = [
    "fk_id_exercicio",
    "letra_respondida",
    "created_at",
    "updated_at"
]
# alunos=fetch_table_data('alunos')
nomes_das_colunas_alunos = ['cpf_aluno', 'rg_aluno', 'nome_aluno', 'email_aluno', 'celular_aluno', 'escola_aluno', 'serie_aluno', 'imagem_aluno', 'senha_aluno','created_at','updated_at']
#
#
# dt_alunos=pd.DataFrame(alunos, columns=nomes_das_colunas_alunos)
# dt_exercicios=pd.DataFrame(exercicios, columns=nomes_das_colunas_exercicios)
# dt_alternativas=pd.DataFrame(alternativas, columns=nomes_das_colunas_alternativas)
# dt_respostas=pd.DataFrame(respostas, columns=nomes_das_colunas_respostas)
# dt_materias=pd.DataFrame(materias, columns=nomes_das_colunas_materias)
# dt_assuntos=pd.DataFrame(assuntos, columns=nomes_das_colunas_assuntos)

dados_materias = []
for i in range(20):
    dados_materias.append({
        'nome_materia': f'Matéria {i + 1}',
        'created_at': '2023-08-10',
        'updated_at': '2023-08-10'
    })

# Exemplos de dados para a tabela 'assuntos'
dados_assuntos = []
for i in range(20):
    dados_assuntos.append({
        'nome_assunto': f'Assunto {i + 1}',
        'carga_horaria': 10 + (i % 5),
        'fk_materia': f'Matéria {i % 10 + 1}',
        'created_at': '2023-08-10',
        'updated_at': '2023-08-10'
    })

# Exemplos de dados para a tabela 'exercicios'
dados_exercicios = []
for i in range(20):
    dados_exercicios.append({
        'id_exercicio': i + 1,
        'descricao_exercicio': f'Exercício {i + 1}',
        'imagem_exercicio': f'exercicio_{i + 1}.png',
        'ano_exercicio': 2023,
        'vestibular': 'ENEM' if i % 2 == 0 else 'FUVEST',
        'fk_assunto': f'Assunto {i % 10 + 1}',
        'fk_materia': f'Matéria {i % 10 + 1}',
        'created_at': '2023-08-10',
        'updated_at': '2023-08-10'
    })

# Exemplos de dados para a tabela 'alternativas'
dados_alternativas = []
for i in range(20):
    dados_alternativas.append({
        'letra': chr(65 + i),  # Letra A, B, C, ...
        'descricao_alternativa': f"Resposta {chr(65 + i)}",
        'imagem_alternativa': f"imagem_{chr(65 + i)}.png",
        'correta': i % 2 == 0,  # Alternando entre corretas e incorretas
        'fk_id_exercicio': (i % 10) + 1,
        'created_at': '2023-08-10',
        'updated_at': '2023-08-10'
    })

# Exemplos de dados para a tabela 'resposta_alunos'
# dados_respostas = []
# for i in range(20):
#     dados_respostas.append({
#         'fk_id_exercicio': (i % 10) + 1,
#         'letra_respondida': chr(65 + (i % 4)),  # A, B, C, D em sequência
#         'created_at': '2023-08-10',
#         'updated_at': '2023-08-10'
#     })

meses = ['2023-01', '2023-02', '2023-03', '2023-04', '2023-05', '2023-06', '2023-07', '2023-08']

dados_respostas = []
letras = ['A', 'B', 'C', 'D']
for i in range(20):
    data_mes = random.choice(meses)  # Seleciona um mês aleatoriamente
    dia = random.randint(1, 28)  # Seleciona um dia aleatoriamente (assumindo meses com 28 dias)
    data = datetime.strptime(f"{data_mes}-{dia}", "%Y-%m-%d")

    dados_respostas.append({
        'fk_id_exercicio': (i % 10) + 1,
        'letra_respondida': letras[i % 4],
        'created_at': data.strftime("%Y-%m-%d"),
        'updated_at': data.strftime("%Y-%m-%d")
    })

# Exemplos de dados para a tabela 'alunos'
dados_alunos = []
for i in range(20):
    cpf_base = 12345678900 + i
    dados_alunos.append({
        'cpf_aluno': f'{cpf_base + i:011d}',  # CPF fictício
        'rg_aluno': f'{1000000 + i + 1}',  # RG fictício
        'nome_aluno': f'Aluno {i + 1}',
        'email_aluno': f'aluno{i + 1}@example.com',
        'celular_aluno': f'98765432{i + 1:02d}',
        'escola_aluno': f'Escola {chr(65 + (i % 5))}',
        'serie_aluno': f'{i % 5 + 1}º ano',
        'imagem_aluno': f'aluno_{i + 1}.png',
        'senha_aluno': f'senha{i + 1}',
        'created_at': '2023-08-10',
        'updated_at': '2023-08-10'
    })

# Convertendo os exemplos de dados em DataFrames
df_materias = pd.DataFrame(dados_materias)
df_assuntos = pd.DataFrame(dados_assuntos)
df_exercicios = pd.DataFrame(dados_exercicios)
df_alternativas = pd.DataFrame(dados_alternativas)
df_respostas = pd.DataFrame(dados_respostas)
df_alunos = pd.DataFrame(dados_alunos)

df_respostas.rename(columns={'fk_id_exercicio': 'id_exercicio'}, inplace=True)
df_alternativas.rename(columns={'fk_id_exercicio': 'id_exercicio'}, inplace=True)

respostas_exercicios=pd.merge(df_respostas, df_exercicios, on='id_exercicio')
all_response=pd.merge(respostas_exercicios, df_alternativas, on='id_exercicio')
materias_unicas = all_response["fk_materia"].unique()
opcoes_materias = [('todos','todos')] + [(materia,materia) for materia in materias_unicas]

assuntos_unicos = all_response["fk_assunto"].unique()
opcoes_assuntos = [('todos','todos')] + [(assunto,assunto) for assunto in assuntos_unicos]

vestibulares_unicos = all_response["vestibular"].unique()
opcoes_vestibulares = [('todos','todos')] + [(vestibular,vestibular) for vestibular in vestibulares_unicos]

anos_unicos = all_response["ano_exercicio"].unique()
opcoes_anos = [(int(ano), int(ano)) for ano in anos_unicos]
all_response.drop(columns=['descricao_exercicio','imagem_exercicio','created_at_y','updated_at_y',
                 'descricao_alternativa','imagem_alternativa','created_at','updated_at'], inplace=True)

all_response['correta']=False
filtro = (all_response['letra'] == all_response['letra_respondida'])
all_response.loc[filtro, 'correta'] = True
all_response_2=all_response

all_response_2['updated_at_x']=pd.to_datetime(all_response_2['updated_at_x'])
all_response_2['created_at_x']=pd.to_datetime(all_response_2['created_at_x'])


def erros_acertos_materia(all_response, ranking, ordem):
    #     all_response_aux=all_response[all_response['fk_materia']==materia]
    all_response = all_response_2
    all_response_certo = all_response[all_response['correta'] == True]
    contagem_certa = all_response_certo['fk_materia'].value_counts()
    contagem_certa = contagem_certa.reset_index()
    contagem_certa.rename(columns={'index': 'materia'}, inplace=True)

    all_response_errado = all_response[all_response['correta'] == False]
    contagem_errada = all_response_errado['fk_materia'].value_counts()
    contagem_errada = contagem_errada.reset_index()
    contagem_errada.rename(columns={'index': 'materia'}, inplace=True)
    contagem = pd.merge(contagem_certa, contagem_errada, on='materia', how='outer')
    contagem = contagem.fillna(0)
    if contagem.empty:
        return "Sem dados"
    # Plotar o gráfico nos eixos fornecidos
    # ranking_aux=ranking-1
    if ordem == "crescente_erros":
        contagem = contagem.sort_values(by="fk_materia_y", ascending=True)
    elif ordem == "decrescente_erros":
        contagem = contagem.sort_values(by="fk_materia_y", ascending=False)
    elif ordem == "crescente_acertos":
        contagem = contagem.sort_values(by="fk_materia_x", ascending=True)
    elif ordem == "decrescente_acertos":
        contagem = contagem.sort_values(by="fk_materia_x", ascending=False)
    if ranking > len(contagem):
        ranking = len(contagem)

    plt.plot(contagem['materia'][0:ranking], contagem['fk_materia_x'][0:ranking], '-')
    plt.plot(contagem['materia'][0:ranking], contagem['fk_materia_y'][0:ranking], '-')
    plt.xticks(fontsize=7)


def erros_acertos_vestibular(fig, ax, vestibular, ranking, ordem):
    all_response = all_response_2
    all_response_certo = all_response[all_response['correta'] == True]
    all_response_certo = all_response_certo[all_response_certo['vestibular'] == vestibular]
    contagem_certa = all_response_certo['fk_materia'].value_counts()
    contagem_certa = contagem_certa.reset_index()
    contagem_certa.rename(columns={'index': 'materia'}, inplace=True)

    all_response_errado = all_response[all_response['correta'] == False]
    all_response_errado = all_response_errado[all_response_errado['vestibular'] == vestibular]
    contagem_errada = all_response_errado['fk_materia'].value_counts()
    contagem_errada = contagem_errada.reset_index()
    contagem_errada.rename(columns={'index': 'materia'}, inplace=True)
    contagem = pd.merge(contagem_certa, contagem_errada, on='materia', how='outer')
    contagem = contagem.fillna(0)
    if contagem.empty:
        return "Sem dados"
    # Plotar o gráfico nos eixos fornecidos
    # ranking_aux=ranking-1
    if ordem == "crescente_erros":
        contagem = contagem.sort_values(by="fk_materia_y", ascending=True)
    elif ordem == "decrescente_erros":
        contagem = contagem.sort_values(by="fk_materia_y", ascending=False)
    elif ordem == "crescente_acertos":
        contagem = contagem.sort_values(by="fk_materia_x", ascending=True)
    elif ordem == "decrescente_acertos":
        contagem = contagem.sort_values(by="fk_materia_x", ascending=False)
    if ranking > len(contagem):
        ranking = len(contagem)
    ax.plot(contagem["materia"][0:ranking], contagem["fk_materia_x"][0:ranking], "-")
    ax.plot(contagem["materia"][0:ranking], contagem["fk_materia_y"][0:ranking], "-")
    ax.set_xticks(contagem["materia"][0:ranking])
    ax.set_xticklabels(contagem["materia"][0:ranking], fontsize=7)


def linha_temporal_materia(materia, vestibular, ano_i, ano_f, ranking, ordem):
    try:
        fig, ax = plt.subplots(figsize=(14, 11))
        all_response = all_response_2
        if "todos" not in vestibular:
            all_response = all_response[all_response['vestibular'].isin(vestibular)]
        if "todos" not in materia:
            all_response = all_response[all_response['fk_materia'].isin(materia)]
        all_response = all_response[all_response["ano_exercicio"] >= ano_i]
        all_response = all_response[all_response["ano_exercicio"] <= ano_f]

        all_response_certo = all_response[all_response["correta"] == True]
        all_response_certo['mes'] = all_response_certo['created_at_x'].dt.to_period('M')
        certo_grouped = all_response_certo.groupby('mes').size().reset_index(name='ocorrencias_por_mes')

        all_response_errado = all_response[all_response["correta"] == False]
        all_response_errado['mes'] = all_response_errado['created_at_x'].dt.to_period('M')
        errado_grouped = all_response_errado.groupby('mes').size().reset_index(name='ocorrencias_por_mes')

        contagem = pd.merge(errado_grouped, certo_grouped, on="mes", how="outer")
        contagem = contagem.fillna(0)
    #     return contagem
        contagem['mes'] = contagem['mes'].astype(str)
        if contagem.empty:
            return "Sem dados"
        # Plotar o gráfico nos eixos fornecidos
        # ranking_aux=ranking-1
        if ordem == "crescente_erros":
            contagem = contagem.sort_values(by="ocorrencias_por_mes_x", ascending=True)
        elif ordem == "decrescente_erros":
            contagem = contagem.sort_values(by="ocorrencias_por_mes_x", ascending=False)
        elif ordem == "crescente_acertos":
            contagem = contagem.sort_values(by="ocorrencias_por_mes_y", ascending=True)
        elif ordem == "decrescente_acertos":
            contagem = contagem.sort_values(by="ocorrencias_por_mes_y", ascending=False)
        if ranking > len(contagem):
            ranking = len(contagem)
#     # Plotar o gráfico nos eixos fornecidos
#     linha_errado=ax.plot(contagem["mes"], contagem["ocorrencias_por_mes_x"], "-")
#     linha_certo=ax.plot(contagem["mes"], contagem["ocorrencias_por_mes_y"], "-")
#     ax.legend([linha_errado, linha_certo], ['Errado', 'Certo'])
#     ax.set_xticks(contagem["mes"])
#     ax.set_xticklabels(contagem["mes"], fontsize=7)
        plt.xlabel("Mês")
        plt.ylabel("Número de Ocorrências")
        plt.title("Evolução de Respostas ao Longo do Meses(Matéria)")
        plt.plot(contagem["mes"][0:ranking], contagem["ocorrencias_por_mes_x"][0:ranking], "-", label='Errado')
        plt.plot(contagem["mes"][0:ranking], contagem["ocorrencias_por_mes_y"][0:ranking], "-", label='Certo')
        plt.xticks(range(len(contagem[0:ranking])), contagem["mes"][0:ranking], fontsize=7, rotation=45)
        plt.legend()
    except Exception as e:
        return f"Erro ao criar o gráfico: {str(e)}"
    return plt
def linha_temporal_assunto(assuntos, vestibular, ano_i, ano_f, ranking, ordem):
    try:
        fig, ax = plt.subplots(figsize=(14, 11))
        all_response = all_response_2
        if "todos" not in vestibular:
            all_response = all_response[all_response['vestibular'].isin(vestibular)]
        if "todos" not in assuntos:
            all_response = all_response[all_response['fk_assunto'].isin(assuntos)]
    #         return all_response
        all_response = all_response[all_response["ano_exercicio"] >= ano_i]
        all_response = all_response[all_response["ano_exercicio"] <= ano_f]

        all_response_certo = all_response[all_response["correta"] == True]
        all_response_certo['mes'] = all_response_certo['created_at_x'].dt.to_period('M')
        certo_grouped = all_response_certo.groupby('mes').size().reset_index(name='ocorrencias_por_mes')

        all_response_errado = all_response[all_response["correta"] == False]
        all_response_errado['mes'] = all_response_errado['created_at_x'].dt.to_period('M')
        errado_grouped = all_response_errado.groupby('mes').size().reset_index(name='ocorrencias_por_mes')

        contagem = pd.merge(errado_grouped, certo_grouped, on="mes", how="outer")
        contagem = contagem.fillna(0)
    #     return contagem
        contagem['mes'] = contagem['mes'].astype(str)
        if contagem.empty:
            return "Sem dados"
            # Plotar o gráfico nos eixos fornecidos
            # ranking_aux=ranking-1
        if ordem == "crescente_erros":
            contagem = contagem.sort_values(by="ocorrencias_por_mes_x", ascending=True)
        elif ordem == "decrescente_erros":
            contagem = contagem.sort_values(by="ocorrencias_por_mes_x", ascending=False)
        elif ordem == "crescente_acertos":
            contagem = contagem.sort_values(by="ocorrencias_por_mes_y", ascending=True)
        elif ordem == "decrescente_acertos":
            contagem = contagem.sort_values(by="ocorrencias_por_mes_y", ascending=False)
        if ranking > len(contagem):
            ranking = len(contagem)
        ax.set_xlabel("Mês", fontsize=14)
        ax.set_ylabel("Quantidade de Respostas", fontsize=14)
        ax.set_title("A Evolução de Respostas ao Longo do Meses(Assunto)", fontsize=14)
        plt.plot(contagem["mes"][0:ranking], contagem["ocorrencias_por_mes_x"][0:ranking], "-", label='Errado')
        plt.plot(contagem["mes"][0:ranking], contagem["ocorrencias_por_mes_y"][0:ranking], "-", label='Certo')
        plt.xticks(range(len(contagem[0:ranking])), contagem["mes"][0:ranking], fontsize=7, rotation=45)
        ax.legend()
    except Exception as e:
        return f"Erro ao criar o gráfico: {str(e)}"
    return plt
def linha_temporal_materia_semana(materias, vestibular, ano_i, ano_f, ranking, ordem):
    try:
        fig, ax=plt.subplots(figsize=(14, 11))
        all_response = all_response_2
        if "todos" not in vestibular:
            all_response = all_response[all_response['vestibular'].isin(vestibular)]
        if "todos" not in materias:
            all_response = all_response[all_response['fk_materia'].isin(materias)]
        all_response = all_response[all_response["ano_exercicio"] >= ano_i]
        all_response = all_response[all_response["ano_exercicio"] <= ano_f]

        all_response_certo = all_response[all_response["correta"] == True]
        all_response_certo['week'] = all_response_certo['created_at_x'].dt.to_period('W')
        certo_grouped = all_response_certo.groupby('week').size().reset_index(name='ocorrencias_por_semana')
    #     return all_response_certo

        all_response_errado = all_response[all_response["correta"] == False]
        all_response_errado['week'] = all_response_errado['created_at_x'].dt.to_period('W')
        errado_grouped = all_response_errado.groupby('week').size().reset_index(name='ocorrencias_por_semana')

        contagem = pd.merge(errado_grouped, certo_grouped, on="week", how="outer")
        contagem = contagem.fillna(0)
        contagem['week'] = contagem['week'].astype(str)
        if contagem.empty:
            return "Sem dados"
            # Plotar o gráfico nos eixos fornecidos
            # ranking_aux=ranking-1
        if ordem == "crescente_erros":
            contagem = contagem.sort_values(by="ocorrencias_por_semana_x", ascending=True)
        elif ordem == "decrescente_erros":
            contagem = contagem.sort_values(by="ocorrencias_por_semana_x", ascending=False)
        elif ordem == "crescente_acertos":
            contagem = contagem.sort_values(by="ocorrencias_por_semana_y", ascending=True)
        elif ordem == "decrescente_acertos":
            contagem = contagem.sort_values(by="ocorrencias_por_semana_y", ascending=False)
        if ranking > len(contagem):
            ranking = len(contagem)
        ax.plot(contagem["week"][0:ranking], contagem["ocorrencias_por_semana_x"][0:ranking], "-", label='Errado')
        ax.plot(contagem["week"][0:ranking], contagem["ocorrencias_por_semana_y"][0:ranking], "-", label='Certo')
        ax.set_xticks(range(len(contagem[0:ranking])))
        ax.set_xticklabels(contagem["week"][0:ranking], fontsize=7, rotation=45)
        ax.set_xlabel("Semanas", fontsize=14)
        ax.set_ylabel("Quantidade de Respostas", fontsize=14)
        ax.set_title("Acertos por Matéria Tempo", fontsize=14)
        ax.legend()
    except Exception as e:
        return f"Erro ao criar o gráfico: {str(e)}"
    return plt
def linha_temporal_assunto_semana(assuntos, vestibular, ano_i, ano_f, ranking, ordem):
    try:
        fig, ax=plt.subplots(figsize=(14, 11))
        all_response = all_response_2
        if "todos" not in vestibular:
            all_response = all_response[all_response['vestibular'].isin(vestibular)]
        if "todos" not in assuntos:
            all_response = all_response[all_response['fk_assunto'].isin(assuntos)]
    #     return all_response
        all_response = all_response[all_response["ano_exercicio"] >= ano_i]
        all_response = all_response[all_response["ano_exercicio"] <= ano_f]

        all_response_certo = all_response[all_response["correta"] == True]
        all_response_certo['week'] = all_response_certo['created_at_x'].dt.to_period('W')
        certo_grouped = all_response_certo.groupby('week').size().reset_index(name='ocorrencias_por_semana')
    #     return certo_grouped

        all_response_errado = all_response[all_response["correta"] == False]
        all_response_errado['week'] = all_response_errado['created_at_x'].dt.to_period('W')
        errado_grouped = all_response_errado.groupby('week').size().reset_index(name='ocorrencias_por_semana')

        contagem = pd.merge(errado_grouped, certo_grouped, on="week", how="outer")
        contagem = contagem.fillna(0)
        contagem['week'] = contagem['week'].astype(str)
        if contagem.empty:
            return "Sem dados"
            # Plotar o gráfico nos eixos fornecidos
            # ranking_aux=ranking-1
        if ordem == "crescente_erros":
            contagem = contagem.sort_values(by="ocorrencias_por_semana_x", ascending=True)
        elif ordem == "decrescente_erros":
            contagem = contagem.sort_values(by="ocorrencias_por_semana_x", ascending=False)
        elif ordem == "crescente_acertos":
            contagem = contagem.sort_values(by="ocorrencias_por_semana_y", ascending=True)
        elif ordem == "decrescente_acertos":
            contagem = contagem.sort_values(by="ocorrencias_por_semana_y", ascending=False)
        if ranking > len(contagem):
            ranking = len(contagem)

        ax.plot(contagem["week"][0:ranking], contagem["ocorrencias_por_semana_x"][0:ranking], "-", label='Errado')
        ax.plot(contagem["week"][0:ranking], contagem["ocorrencias_por_semana_y"][0:ranking], "-", label='Certo')
        ax.set_xticks(range(len(contagem[0:ranking])))
        ax.set_xticklabels(contagem["week"][0:ranking], fontsize=7, rotation=45)
        ax.set_xlabel("Semanas", fontsize=14)
        ax.set_ylabel("Quantidade de Respostas", fontsize=14)
        ax.set_title("Acertos por Assunto em Semanas", fontsize=14)
        ax.legend()
    except Exception as e:
        return f"Erro ao criar o gráfico: {str(e)}"
    return plt

def erros_acertos_ano(vestibular, ano_i, ano_f, ranking, ordem):
    try:
        fig, ax = plt.subplots(figsize=(12, 8))
        all_response = all_response_2
        if "todos" not in vestibular:
            all_response = all_response[all_response['vestibular'].isin(vestibular)]
        all_response = all_response[all_response["ano_exercicio"] >= ano_i]
        all_response = all_response[all_response["ano_exercicio"] <= ano_f]

        all_response_certo = all_response[all_response["correta"] == True]
        contagem_certa = all_response_certo["fk_materia"].value_counts()
        contagem_certa = contagem_certa.reset_index()
        contagem_certa.rename(columns={"index": "materia"}, inplace=True)

        all_response_errado = all_response[all_response["correta"] == False]
        contagem_errada = all_response_errado["fk_materia"].value_counts()
        contagem_errada = contagem_errada.reset_index()
        contagem_errada.rename(columns={"index": "materia"}, inplace=True)
        contagem = pd.merge(contagem_certa, contagem_errada, on="materia", how="outer")
        contagem = contagem.fillna(0)
        if contagem.empty:
            return "Sem dados"
        # Plotar o gráfico nos eixos fornecidos
        # ranking_aux=ranking-1
        if ordem == "crescente_erros":
            contagem = contagem.sort_values(by="fk_materia_y", ascending=True)
        elif ordem == "decrescente_erros":
            contagem = contagem.sort_values(by="fk_materia_y", ascending=False)
        elif ordem == "crescente_acertos":
            contagem = contagem.sort_values(by="fk_materia_x", ascending=True)
        elif ordem == "decrescente_acertos":
            contagem = contagem.sort_values(by="fk_materia_x", ascending=False)
        if ranking > len(contagem):
            ranking = len(contagem)
        ax.plot(contagem["materia"][0:ranking], contagem["fk_materia_x"][0:ranking], "-", label="Acertos")
        ax.plot(contagem["materia"][0:ranking], contagem["fk_materia_y"][0:ranking], "-", label="Erros")
        ax.set_xticks(contagem["materia"][0:ranking])
        ax.set_xticklabels(contagem["materia"][0:ranking], fontsize=7)
        ax.set_xlabel("Materias", fontsize=14)
        ax.set_ylabel("Quantidade de Respostas", fontsize=14)
        ax.set_title("Acertos por matéria", fontsize=14)
        ax.legend()
    except Exception as e:
        return f"Erro ao criar o gráfico: {str(e)}"
    return plt

#     plt.plot(range(1,11), valores2,'*--' )
#     plt.plot(range(1,11), valores3, 'v-.' )

def erros_acertos_ano_assunto(vestibular, ano_i, ano_f, ranking, ordem):
    try:
        fig, ax = plt.subplots(figsize=(12, 8))
        all_response = all_response_2
        if "todos" not in vestibular:
            all_response = all_response[all_response['vestibular'].isin(vestibular)]
        all_response = all_response[all_response["ano_exercicio"] >= ano_i]
        all_response = all_response[all_response["ano_exercicio"] <= ano_f]

        all_response_certo = all_response[all_response["correta"] == True]
        contagem_certa = all_response_certo["fk_assunto"].value_counts()
        contagem_certa = contagem_certa.reset_index()
        contagem_certa.rename(columns={"index": "assunto"}, inplace=True)

        all_response_errado = all_response[all_response["correta"] == False]
        contagem_errada = all_response_errado["fk_assunto"].value_counts()
        contagem_errada = contagem_errada.reset_index()
        contagem_errada.rename(columns={"index": "assunto"}, inplace=True)
        contagem = pd.merge(contagem_certa, contagem_errada, on="assunto", how="outer")
        contagem = contagem.fillna(0)
        if contagem.empty:
            return "Sem dados"
        if ordem == "crescente_erros":
            contagem = contagem.sort_values(by="fk_assunto_y", ascending=True)
        elif ordem == "decrescente_erros":
            contagem = contagem.sort_values(by="fk_assunto_y", ascending=False)
        elif ordem == "crescente_acertos":
            contagem = contagem.sort_values(by="fk_assunto_x", ascending=True)
        elif ordem == "decrescente_acertos":
            contagem = contagem.sort_values(by="fk_assunto_x", ascending=False)
        if ranking > len(contagem):
            ranking = len(contagem)

        # Plotar o gráfico nos eixos fornecidos
        ax.plot(contagem["assunto"][0:ranking], contagem["fk_assunto_x"][0:ranking], "-", label="Acertos")
        ax.plot(contagem["assunto"][0:ranking], contagem["fk_assunto_y"][0:ranking], "-", label="Erros")
        ax.set_xticks(contagem["assunto"][0:ranking])
        ax.set_xticklabels(contagem["assunto"][0:ranking], rotation=45, ha="right", fontsize=7)
        ax.set_xlabel("Assuntos", fontsize=14)
        ax.set_ylabel("Quantidade de Respostas", fontsize=14)
        ax.set_title("Acertos por Assunto", fontsize=14)
        ax.legend()

    except Exception as e:
        return f"Erro ao criar o gráfico: {str(e)}"

    return plt
def erros_acertos_ano_vestibular(materias, assuntos, ano_i, ano_f, ranking, ordem):
    try:
        fig, ax = plt.subplots(figsize=(12, 8))
        all_response = all_response_2
        all_response = all_response[all_response["ano_exercicio"] >= ano_i]
        all_response = all_response[all_response["ano_exercicio"] <= ano_f]
        if "todos" not in assuntos:
            all_response = all_response[all_response['fk_assunto'].isin(assuntos)]
        if "todos" not in materias:
            all_response = all_response[all_response['fk_materia'].isin(materias)]

        all_response_certo = all_response[all_response["correta"] == True]
        contagem_certa = all_response_certo["vestibular"].value_counts()
        contagem_certa = contagem_certa.reset_index()
        contagem_certa.rename(columns={"index": "vestibular_nome"}, inplace=True)
        all_response_errado = all_response[all_response["correta"] == False]
        contagem_errada = all_response_errado["vestibular"].value_counts()
        contagem_errada = contagem_errada.reset_index()
        contagem_errada.rename(columns={"index": "vestibular_nome"}, inplace=True)
        contagem = pd.merge(contagem_certa, contagem_errada, on="vestibular_nome", how="outer")
        contagem = contagem.fillna(0)
        #     return contagem
        # Plotar o gráfico nos eixos fornecidos
        #     ax.plot(contagem["vestibular_nome"], contagem["vestibular_x"], "-")
        #     ax.plot(contagem["vestibular_nome"], contagem["vestibular_y"], "-")
        #     ax.set_xticks(contagem["vestibular_nome"])
        #     ax.set_xticklabels(contagem["vestibular_nome"], fontsize=7)
        if contagem.empty:
            return "Sem dados"
        if ordem == "crescente_erros":
            contagem = contagem.sort_values(by="vestibular_y", ascending=True)
        elif ordem == "decrescente_erros":
            contagem = contagem.sort_values(by="vestibular_y", ascending=False)
        elif ordem == "crescente_acertos":
            contagem = contagem.sort_values(by="vestibular_x", ascending=True)
        elif ordem == "decrescente_acertos":
            contagem = contagem.sort_values(by="vestibular_x", ascending=False)
        if ranking > len(contagem):
            ranking = len(contagem)
        ax.plot(contagem["vestibular_nome"][0:ranking], contagem["vestibular_x"][0:ranking], "-o", label="Corretas")
        ax.plot(contagem["vestibular_nome"][0:ranking], contagem["vestibular_y"][0:ranking], "-o", label="Incorretas")
        ax.set_xticks(contagem["vestibular_nome"][0:ranking])
        ax.set_xticklabels(contagem["vestibular_nome"][0:ranking], rotation=45, ha="right", fontsize=7)
        ax.set_xlabel("Vestibulares", fontsize=14)
        ax.set_ylabel("Quantidade de Respostas", fontsize=14)
        ax.set_title("Acertos por vestibular", fontsize=14)
        ax.legend()
    except Exception as e:
        return f"Erro ao criar o gráfico: {str(e)}"

    return plt



app = Flask(__name__)


correct_email = "a@a"
correct_password = "a"


# Função para verificar se o usuário está autenticado
def usuário_está_autenticado():
    return "autenticado" in session

@app.route('/')
def index():
    session["autenticado"] = False
    if not usuário_está_autenticado():
        return redirect(url_for('login_redirect'))
    return redirect(url_for('login_redirect'))

@app.route("/login_redirect", methods=['GET', 'POST'])
def login_redirect():
    if request.method == 'POST':
        email = request.form['email']
        password = request.form['password']
        if email == correct_email and password == correct_password:
            session["autenticado"] = True
            return redirect(url_for('estatistica_vestibular'))
        else:
            error_message = "Credenciais inválidas"
            return render_template('login.html', error_message=error_message)
    return render_template("login.html")

@app.route("/estatistica")
def estatistica():
    if not usuário_está_autenticado():
        return redirect(url_for('login_redirect'))
    # Crie um gráfico usando a função erros_acertos_ano
    fig, ax = plt.subplots()
    erros_acertos_ano(
        fig, ax, "ENEM", 2020, 2030
    )  # Chamada da função com o gráfico a ser plotado

    # Salve o gráfico como uma imagem temporária
    img_path = os.path.join(app.static_folder, "chart.png")
    fig.savefig(img_path)

    return render_template("estatisticas.html", chart_image="chart.png")
# @app.route("/homepage")
# def homepage():
#     if not usuário_está_autenticado():
#         return redirect(url_for('login_redirect'))
#
#     # Crie um gráfico usando a função erros_acertos_ano
#     fig, ax = plt.subplots()
#     erros_acertos_ano(
#         fig, ax, "ENEM", 2020, 2030
#     )  # Chamada da função com o gráfico a ser plotado
#
#     # Salve o gráfico como uma imagem temporária
#     img_path = os.path.join(app.static_folder, "materia.png")
#     fig.savefig(img_path)
#
#     return render_template("index.html", chart_image="materia.png")
from flask import jsonify
# ROTAS GERAIS PARA ESTATISTICAS ----------------------------------------------------------------------------------------------------------------------------------------
@app.route('/estatistica_vestibular')
def estatistica_vestibular():
    # Chame a função para obter o widget interativo
    # widget = roda_erros_acertos_ano_vestibular()
    # widget_html = widget.children[0].children[1].children[0].render()

    # all_response_2_json = all_response_2.to_json(orient='records')
    #
    # # Retornar o JSON como resposta HTTP
    # return jsonify(all_response_2_json)
    return render_template('estatisticas_vestibulares.html', opcoes_assuntos=opcoes_assuntos, opcoes_materias=opcoes_materias, opcoes_anos=opcoes_anos)

@app.route('/estatistica_materia')
def estatistica_materia():

    return render_template('estatisticas_materias.html', opcoes_vestibulares=opcoes_vestibulares,opcoes_anos=opcoes_anos)

@app.route('/estatistica_assunto')
def estatistica_assunto():

    return render_template('estatisticas_assuntos.html', opcoes_vestibulares=opcoes_vestibulares,opcoes_anos=opcoes_anos)

@app.route('/estatistica_semana_materia')
def estatistica_semana_materia():
    return render_template('estatisticas_semana_materias.html', opcoes_vestibulares=opcoes_vestibulares, opcoes_materias=opcoes_materias,opcoes_anos=opcoes_anos)

@app.route('/estatistica_mes_materia')
def estatistica_mes_materia():
    return render_template('estatisticas_mes_materias.html', opcoes_vestibulares=opcoes_vestibulares, opcoes_materias=opcoes_materias,opcoes_anos=opcoes_anos)

@app.route('/estatistica_semana_assunto')
def estatistica_semana_assunto():
    return render_template('estatisticas_semana_assuntos.html', opcoes_vestibulares=opcoes_vestibulares,opcoes_assuntos=opcoes_assuntos,opcoes_anos=opcoes_anos)

@app.route('/estatistica_mes_assunto')
def estatistica_mes_assunto():
    return render_template('estatisticas_mes_assuntos.html', opcoes_vestibulares=opcoes_vestibulares,opcoes_assuntos=opcoes_assuntos,opcoes_anos=opcoes_anos)
#  ----------------------------------------------------------------------------------------------------------------------------------------

# ROTAS PARA PROCESSAR FORMS ----------------------------------------------------------------------------------------------------------------------------------------


@app.route('/processar_form', methods=['POST'])
def processar_form():
    nome_funcao = request.form.get('funcao')
    if(nome_funcao=="erros_acertos_ano_vestibular"):
        try:
            materias = request.form.getlist('materias')
            assuntos = request.form.getlist('assuntos')
            ano_i = int(request.form.get('ano_i'))
            ano_f = int(request.form.get('ano_f'))
            ranking = int(request.form.get('ranking'))
            ordem = request.form.get('ordem')
            # ano_i = int(ano_i_aux)  # Remove o [0] aqui
            # ano_f = int(ano_f_aux)  # Remove o [0] aqui
            # Converta os valores para inteiros

            chart = erros_acertos_ano_vestibular(materias, assuntos, ano_i, ano_f, ranking, ordem)
            buffer = io.BytesIO()
            chart.savefig(buffer, format='png')
            buffer.seek(0)
            chart_base64 = base64.b64encode(buffer.read()).decode('utf-8')

            # Crie um HTML que incorpora o gráfico
            chart_html = f'<img src="data:image/png;base64,{chart_base64}">'

            return render_template('estatisticas_vestibulares.html', chart_html=chart_html,  opcoes_assuntos=opcoes_assuntos, opcoes_materias=opcoes_materias, opcoes_anos=opcoes_anos)
        except Exception as e:
             mensagem_erro = f"Erro ao criar o gráfico, lembre-se de preencher todos os campos.Se estiverem preenchidos, provavelmente os filtros colocados não resultaram em nenhuma ocorrência de informações, o que geraria um gráfico vazio."
             return render_template('estatisticas_vestibulares.html', chart_html=" ", mensagem_erro=mensagem_erro,  opcoes_assuntos=opcoes_assuntos, opcoes_materias=opcoes_materias, opcoes_anos=opcoes_anos)
    if (nome_funcao == "erros_acertos_ano"):
        try:
            vestibulares = request.form.getlist('vestibulares')
            ano_i = int(request.form.get('ano_i'))
            ano_f = int(request.form.get('ano_f'))
            ranking = int(request.form.get('ranking'))
            ordem = request.form.get('ordem')


            # ano_i = int(ano_i_aux)  # Remove o [0] aqui
            # ano_f = int(ano_f_aux)  # Remove o [0] aqui
            # Converta os valores para inteiros

            chart = erros_acertos_ano(vestibulares, ano_i, ano_f, ranking, ordem)
            # return render_template('estatisticas_materias.html', chart_html=" ", mensagem_erro=chart,
            #                        opcoes_vestibulares=opcoes_vestibulares, opcoes_anos=opcoes_anos)

            buffer = io.BytesIO()
            chart.savefig(buffer, format='png')
            buffer.seek(0)
            chart_base64 = base64.b64encode(buffer.read()).decode('utf-8')

            # Crie um HTML que incorpora o gráfico
            chart_html = f'<img src="data:image/png;base64,{chart_base64}">'

            return render_template('estatisticas_materias.html', chart_html=chart_html, opcoes_vestibulares=opcoes_vestibulares, opcoes_anos=opcoes_anos)
        except Exception as e:
             mensagem_erro = f"Erro ao criar o gráfico, lembre-se de preencher todos os campos.Se estiverem preenchidos, provavelmente os filtros colocados não resultaram em nenhuma ocorrência de informações, o que geraria um gráfico vazio."
             return render_template('estatisticas_materias.html', chart_html=" ", mensagem_erro=mensagem_erro,  opcoes_vestibulares=opcoes_vestibulares, opcoes_anos=opcoes_anos)
    if (nome_funcao == "erros_acertos_ano_assunto"):
        try:
            vestibulares = request.form.getlist('vestibulares')
            materias = request.form.getlist('materias')
            ano_i = int(request.form.get('ano_i'))
            ano_f = int(request.form.get('ano_f'))
            ranking = int(request.form.get('ranking'))
            ordem = request.form.get('ordem')

            chart = erros_acertos_ano_assunto(vestibulares, ano_i, ano_f, ranking, ordem)
            buffer = io.BytesIO()
            chart.savefig(buffer, format='png')
            buffer.seek(0)
            chart_base64 = base64.b64encode(buffer.read()).decode('utf-8')

            # Crie um HTML que incorpora o gráfico
            chart_html = f'<img src="data:image/png;base64,{chart_base64}">'

            return render_template('estatisticas_assuntos.html', chart_html=chart_html,
                                   opcoes_vestibulares=opcoes_vestibulares, opcoes_anos=opcoes_anos)
        except Exception as e:
            mensagem_erro = f"Erro ao criar o gráfico, lembre-se de preencher todos os campos.Se estiverem preenchidos, provavelmente os filtros colocados não resultaram em nenhuma ocorrência de informações, o que geraria um gráfico vazio."
            return render_template('estatisticas_assuntos.html', chart_html=" ", mensagem_erro=mensagem_erro,
                                   opcoes_vestibulares=opcoes_vestibulares, opcoes_anos=opcoes_anos)
    if(nome_funcao=="linha_temporal_materia_semana"):
        try:
            vestibulares = request.form.getlist('vestibulares')
            materias = request.form.getlist('materias')
            ano_i = int(request.form.get('ano_i'))
            ano_f = int(request.form.get('ano_f'))
            ranking = int(request.form.get('ranking'))
            ordem = request.form.get('ordem')
            chart = linha_temporal_materia_semana(materias,vestibulares, ano_i, ano_f, ranking, ordem)
            # return chart
            buffer = io.BytesIO()
            chart.savefig(buffer, format='png')
            buffer.seek(0)
            chart_base64 = base64.b64encode(buffer.read()).decode('utf-8')

            # Crie um HTML que incorpora o gráfico
            chart_html = f'<img src="data:image/png;base64,{chart_base64}">'

            return render_template('estatisticas_semana_materias.html', chart_html=chart_html,opcoes_materias=opcoes_materias,
                                   opcoes_vestibulares=opcoes_vestibulares, opcoes_anos=opcoes_anos)
        except Exception as e:
            mensagem_erro = f"Erro ao criar o gráfico, lembre-se de preencher todos os campos.Se estiverem preenchidos, provavelmente os filtros colocados não resultaram em nenhuma ocorrência de informações, o que geraria um gráfico vazio."
            return render_template('estatisticas_semana_materias.html', chart_html=" ", mensagem_erro=mensagem_erro, opcoes_materias=opcoes_materias,
                                   opcoes_vestibulares=opcoes_vestibulares, opcoes_anos=opcoes_anos)
    if (nome_funcao == "linha_temporal_materia"):
        try:
            vestibulares = request.form.getlist('vestibulares')
            materias = request.form.getlist('materias')
            ano_i = int(request.form.get('ano_i'))
            ano_f = int(request.form.get('ano_f'))
            ranking = int(request.form.get('ranking'))
            ordem = request.form.get('ordem')
            chart = linha_temporal_materia(materias, vestibulares, ano_i, ano_f, ranking, ordem)
            # return chart
            buffer = io.BytesIO()
            chart.savefig(buffer, format='png')
            buffer.seek(0)
            chart_base64 = base64.b64encode(buffer.read()).decode('utf-8')

            # Crie um HTML que incorpora o gráfico
            chart_html = f'<img src="data:image/png;base64,{chart_base64}">'

            return render_template('estatisticas_mes_materias.html', chart_html=chart_html,
                                   opcoes_materias=opcoes_materias,
                                   opcoes_vestibulares=opcoes_vestibulares, opcoes_anos=opcoes_anos)
        except Exception as e:
            mensagem_erro = f"Erro ao criar o gráfico, lembre-se de preencher todos os campos.Se estiverem preenchidos, provavelmente os filtros colocados não resultaram em nenhuma ocorrência de informações, o que geraria um gráfico vazio."
            return render_template('estatisticas_mes_materias.html', chart_html=" ", mensagem_erro=mensagem_erro,
                                   opcoes_materias=opcoes_materias,
                                   opcoes_vestibulares=opcoes_vestibulares, opcoes_anos=opcoes_anos)
    if (nome_funcao == "linha_temporal_assunto"):
        try:
            vestibulares = request.form.getlist('vestibulares')
            assuntos = request.form.getlist('assuntos')
            ano_i = int(request.form.get('ano_i'))
            ano_f = int(request.form.get('ano_f'))
            ranking = int(request.form.get('ranking'))
            ordem = request.form.get('ordem')
            chart = linha_temporal_assunto(assuntos, vestibulares, ano_i, ano_f, ranking, ordem)
            # return chart
            buffer = io.BytesIO()
            chart.savefig(buffer, format='png')
            buffer.seek(0)
            chart_base64 = base64.b64encode(buffer.read()).decode('utf-8')

            # Crie um HTML que incorpora o gráfico
            chart_html = f'<img src="data:image/png;base64,{chart_base64}">'

            return render_template('estatisticas_mes_assuntos.html', chart_html=chart_html,
                                   opcoes_assuntos=opcoes_assuntos,
                                   opcoes_vestibulares=opcoes_vestibulares, opcoes_anos=opcoes_anos)
        except Exception as e:
            mensagem_erro = f"Erro ao criar o gráfico, lembre-se de preencher todos os campos.Se estiverem preenchidos, provavelmente os filtros colocados não resultaram em nenhuma ocorrência de informações, o que geraria um gráfico vazio."
            return render_template('estatisticas_mes_assuntos.html', chart_html=" ", mensagem_erro=e,
                                   opcoes_assuntos=opcoes_assuntos,
                                   opcoes_vestibulares=opcoes_vestibulares, opcoes_anos=opcoes_anos)
    if (nome_funcao == "linha_temporal_assunto_semana"):
        try:
            vestibulares = request.form.getlist('vestibulares')
            assuntos = request.form.getlist('assuntos')
            ano_i = int(request.form.get('ano_i'))
            ano_f = int(request.form.get('ano_f'))
            ranking = int(request.form.get('ranking'))
            ordem = request.form.get('ordem')
            chart = linha_temporal_assunto_semana(assuntos, vestibulares, ano_i, ano_f, ranking, ordem)
            # return chart
            buffer = io.BytesIO()
            chart.savefig(buffer, format='png')
            buffer.seek(0)
            chart_base64 = base64.b64encode(buffer.read()).decode('utf-8')

            # Crie um HTML que incorpora o gráfico
            chart_html = f'<img src="data:image/png;base64,{chart_base64}">'

            return render_template('estatisticas_semana_assuntos.html', chart_html=chart_html,
                                   opcoes_assuntos=opcoes_assuntos,
                                   opcoes_vestibulares=opcoes_vestibulares, opcoes_anos=opcoes_anos)
        except Exception as e:
            mensagem_erro = f"Erro ao criar o gráfico, lembre-se de preencher todos os campos.Se estiverem preenchidos, provavelmente os filtros colocados não resultaram em nenhuma ocorrência de informações, o que geraria um gráfico vazio."
            return render_template('estatisticas_mes_assuntos.html', chart_html=" ", mensagem_erro=e,
                                   opcoes_assuntos=opcoes_assuntos,
                                   opcoes_vestibulares=opcoes_vestibulares, opcoes_anos=opcoes_anos)
if __name__ == "__main__":
    app.secret_key = "sua_chave_secreta"
    app.run(debug=True)

# GABRIELLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLL COLOCAR VALUE PADRÃO EM SELECT PARA PESSOA PERCEBER QUE PODE MARCAR MAIS DE UM
#FAZER GRÁFICO POR DATA
#CONSIDERAR APENAS OS 10 PRIMEIROS, 15 PRIMEIROS, CASO TENHAM MUITAS COISAS
