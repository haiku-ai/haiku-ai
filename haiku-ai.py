import base64
import openai
import os

#from profanity_filter import ProfanityFilter
from sys import argv

openai.organization = ""
openai.api_key = ""

if len(argv) < 2:
    exit(0)

topic_array = []
for topic in argv[1:]:
    topic_array.append(topic)

topic = " ".join(topic_array)

#ProfanityFilter().censor(topic)

prompt = "write a haiku about " + topic
engine = "text-davinci-003"
max_tokens = 1000

image_dir = "openai_images/"
original_image_path = image_dir + topic
image_path = image_dir + topic + ".png"

haiku = openai.Completion.create(engine=engine, prompt=prompt, max_tokens=max_tokens).choices[0].text
print(haiku)

image = openai.Image.create(prompt=haiku,response_format="b64_json").data[0].b64_json

index = 1

while os.path.exists(image_path):
    image_path = original_image_path + "_" + str(index)  + ".png"
    index += 1

with open(image_path, "wb") as fh:
    fh.write(base64.b64decode(image))

print(image_path)
