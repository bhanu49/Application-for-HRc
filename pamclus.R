.libPaths(c("C:/Users/bhanu/Documents/R/win-library/3.3","C:/Program Files/R/R-3.3.2/library"))
library(dplyr)
library(ggplot2)
library(cluster)
library(Rtsne)
#read data from csv
data<- read.csv(file = "C:/wamp64/www/workbench/clusterdata.csv",sep = ",",encoding = 'UTF-8')
mm<-model.matrix(~InjuryLevel-1,data)#convert factor variables into binary
inj <- model.matrix(~Injury-1,data)
colnames(mm)<- gsub("InjuryLevel","",colnames(mm))#format col name

result <- cbind(data,mm,inj) # combine resultant factor data to orginal data

#cal gower dist to selected columns
gower_dist <- daisy(result[,-1:-5],metric="gower",type = list(logratio=3))

gower_mat <- as.matrix(gower_dist)
# Calculate silhouette width for many k using PAM
sil_width <- c(NA)

for(i in 2:10){
  
pam_fit <- pam(gower_dist,diss = TRUE,k = i)
  
sil_width[i] <- pam_fit$silinfo$avg.width
  
}

# Plot sihouette width (higher is better)

plot(1:10, sil_width,xlab = "Number of clusters", ylab = "Silhouette Width")
lines(1:10, sil_width)

#clustering using PAM

pam_fit <- pam(gower_dist, diss = TRUE, k = 10)

pam_results <- result %>%
  dplyr::select(-bodypart,-Injury,-Quantity,-Unit,-InjuryLevel) %>%
  mutate(cluster = pam_fit$clustering) %>%
  group_by(cluster) %>%
  do(the_summary = summary(.))

clus_sumary <- pam_results$the_summary
medians <- result[pam_fit$medoids, ]
medians
#plotting
png(filename="pam.png", width=500, height=500)
tsne_obj <- Rtsne(gower_dist, is_distance = TRUE)

tsne_data <- tsne_obj$Y %>%
  data.frame() %>%
  setNames(c("X", "Y")) %>%
  mutate(cluster = factor(pam_fit$clustering),
         name = result$InjuryLevel)

ggplot(aes(x = X, y = Y), data = tsne_data) +
  geom_point(aes(color = cluster))
 dev.off()
